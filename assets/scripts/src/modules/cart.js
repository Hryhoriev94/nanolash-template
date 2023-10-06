export default () => {
    changeInputValueHandler();
}

const cartButtonHandler = () => {
    const cartButton = document.querySelector('[data-cart__button]');
    const cartComponent = document.querySelector('.nav__cart');
    cartButton.addEventListener('click', () => {
        cartComponent.classList.toggle('d-flex');
    })
}

const getCurrency = () => {
    return new Promise((resolve, reject) => {
        const sendData = window.location.hostname;
        fetch('/getData.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `domain=${sendData}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                reject('Product not found');
            } else {
                resolve(data.currency);
            }
        })
        .catch(error => {
            reject(error);
        });
    });
}

let currencyPromise = getCurrency();

const changeInputValueHandler = () => {
    cartButtonHandler();
    currencyPromise.then(currency => {
        const productForms = document.querySelectorAll('.product-form');
        
        productForms.forEach(form => {
            const variantFormElement = form.querySelector('.product__variants');
            const addToCartBlock = form.querySelector('.add-to-cart');
            
            let variantFormInstance;
            if (variantFormElement) {
                variantFormInstance = new VariantForm(variantFormElement);
            }
            if(!localStorage.getItem('currency') || localStorage.getItem('currency') !== currency) {
                localStorage.setItem('currency', currency);
            }
            
            const addToCartFormInstance = new AddToCartForm(addToCartBlock, currency, variantFormInstance);
            
            form.addEventListener('submit', (e) => {
                e.preventDefault();
            });
        });
    }).catch(error => {
        console.error('Error:', error);
    });
}

class AddToCartForm {
    constructor(addToCartBlock, currency, variantForm) {
        this.addToCartBlock = addToCartBlock;
        this.alias = this.addToCartBlock.getAttribute('data-alias');
        this.plus = this.addToCartBlock.querySelector('.add-to-cart__plus');
        this.minus = this.addToCartBlock.querySelector('.add-to-cart__minus');
        this.quantity = this.addToCartBlock.querySelector('.qnt-counter__input') || 
        this.addToCartBlock.querySelector('input.add-to-cart__quantity');
        this.newPrice = this.addToCartBlock.querySelector('.new-price .sum');
        this.oldPrice = this.addToCartBlock.querySelector('.old-price .sum');
        this.currency = currency;
        this.name = this.add
        this.variantForm = variantForm;
        
        this.init();
    }

    async init() {
        this.product = await this.getData();
        this.price = this.product['price'][this.currency];
        this.productId = this.product['id'];  // Получаем ID продукта
        this.listeners();
        this.initPrice();
    }

    plusHandler() {
        this.quantity.value = parseInt(this.quantity.value, 10) + 1;
        if(this.getQuantity() > 1) this.minus.disabled = false;
        this.calculateSum();
    }

    minusHandler() {
        this.quantity.value = Math.max(0, parseInt(this.quantity.value, 10) - 1);
        if(this.getQuantity() <= 1) {
            this.quantity.value = 1;
            this.minus.disabled = true;
        }
        this.calculateSum();
    }

    inputHandler() {
        if(this.getQuantity() <= 1 || !this.getQuantity()) {
            this.quantity.value = 1;
            this.minus.disabled = true;
        }
        this.calculateSum();
    }

    initPrice() {
        this.newPrice.textContent = this.getQuantity() * this.price;
    }

    calculateSum() {
        this.summary = this.getQuantity() * this.price;
        this.newPrice.textContent = this.summary;
    }

    getQuantity() {
        return parseInt(this.quantity.value, 10);
    }

    listeners() {
        this.plus.addEventListener('click', this.plusHandler.bind(this));
        this.minus.addEventListener('click', this.minusHandler.bind(this));
        this.quantity.addEventListener('input', this.inputHandler.bind(this));

        const addToCartButton = this.addToCartBlock.querySelector('.add-to-cart__button');
        addToCartButton.addEventListener('click', this.addToCartHandler.bind(this));
    }

    addToCartHandler() {
        const variantId = this.variantForm ? this.variantForm.variantId : null;
        const comboid = variantId ? `${this.productId}-${variantId}` : this.productId;

        // Здесь добавляем продукт в корзину
        cartInstance.addProduct({
            id: comboid,
            name: 'Product Name',  // Здесь можно использовать реальное имя продукта
            price: this.price,
            quantity: this.getQuantity(),
        });
        cartInstance.updateCartView();
    }

    async getData() {
        const variantId = this.variantForm ? this.variantForm.variantId : null;
        try {
            const response = await fetch('/getData.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `alias=${this.alias}`
            });
            const data = await response.json();
            if (data.error) {
                console.error('Product not found');
                return null;
            } else {
                return data.product; 
            }
        } catch (error) {
            console.error('Error:', error);
            return null;
        }
    }
}

class VariantForm {
    constructor(variantForm) {
        this.form = variantForm;
        this.rows = this.form.querySelectorAll('.product__variant');
        this.variants = this.form.querySelectorAll('.product__variant__block');
        this._variantId = null;
        this._activeVariants = [];
        this.init();

    }

    init() {
        this.searchActiveVariants();
        this.variantId = this.activeVariants;
        this.addClickHandlers();
    }

    addClickHandlers() {
        this.variants.forEach(variant => {
            variant.addEventListener('click', this.changeActiveVariant.bind(this));
        });
    }

    changeActiveVariant(event) {
        const clickedVariant = event.target;
        const row = clickedVariant.closest('.product__variant');

        if (!clickedVariant.classList.contains('active')) {
            const currentActive = row.querySelector('.product__variant__block.active');
            if (currentActive) {
                currentActive.classList.remove('active');
            }
            clickedVariant.classList.add('active');
            this.searchActiveVariants();
            this.variantId = this.activeVariants;
        }
    }

    get activeVariants() {
        return this._activeVariants;
    }

    set activeVariants(variants) {
        if(Array.isArray(variants)) {
            this._activeVariants = variants;
        } else {
            console.error('Variants must be an array');
        }
    }

    searchActiveVariants() {
        const arr = [];
        this.rows.forEach(row => {
            const active = row.querySelector('.product__variant__block.active');
            if (active) {
                arr.push(active);
            }
        });
        this.activeVariants = arr;
    }

    get variantId() {
        return this._variantId;
    }

    set variantId(activeVariants) {
        const id = [];
        activeVariants.forEach(activeVariant => {
            id.push(activeVariant.getAttribute('data-id'));
        });
        this._variantId = id.join('');
    }
}

class Cart {
    constructor() {
        this.cart = this.loadCart();
        this.currency = this.getCurrency();
        this.updateCartView();
        this.addEventListeners();
    }

    loadCart() {
        const cart = localStorage.getItem('cart');
        return cart ? JSON.parse(cart) : [];
    }

    getCurrency() {
        return localStorage.getItem('currency')
    }

    saveCart() {
        localStorage.setItem('cart', JSON.stringify(this.cart));
    }

    addProduct(product) {
        const existingProduct = this.cart.find(item => item.id === product.id && item.variantId === product.variantId);
        if (existingProduct) {
            existingProduct.quantity += product.quantity;
        } else {
            this.cart.push(product);
        }
        this.saveCart();
        this.updateCartView();
    }

    removeProduct(id, variantId) {
        this.cart = this.cart.filter(item => !(item.id === id && (variantId ? item.variantId === variantId : true)));
        this.saveCart();
        this.updateCartView();
    }

    updateQuantity(id, variantId, quantity) {
        const product = this.cart.find(item => item.id === id && item.variantId === variantId);
        if (product) {
            product.quantity = quantity;
        }
        this.saveCart();
        this.updateCartView();
    }

    addEventListeners() {
        const cartDetails = document.querySelector('.nav__cart__details');
    
        cartDetails.addEventListener('click', (e) => {
            const target = e.target;
    
            if (target.matches('[data-navbar-cart-remove]')) {
                const row = target.closest('.nav__cart__row--product');
                const id = row.querySelector('.nav__cart__remove').getAttribute('data-id');
                this.removeProduct(id, null);
            }
    
            if (target.matches('[data-navbar-cart-plus]')) {
                const input = target.closest('.qnt-counter').querySelector('.qnt-counter__input');
                const id = target.closest('.nav__cart__row--product').querySelector('[data-id]').getAttribute('data-id');
                const product = this.cart.find(item => item.id === id);
                product.quantity++;
                input.value = product.quantity;
                this.saveCart();
                this.updateCartView();
            }
    
            if (target.matches('[data-navbar-cart-minus]')) {
                const input = target.closest('.qnt-counter').querySelector('.qnt-counter__input');
                const id = target.closest('.nav__cart__row--product').querySelector('[data-id]').getAttribute('data-id');
                const product = this.cart.find(item => item.id === id);
                if (product.quantity > 1) {
                    product.quantity--;
                    input.value = product.quantity;
                    this.saveCart();
                    this.updateCartView();
                }
            }
        });
    }
    

    updateCartView() {
        this.updateCartSummary();
        const cartDetails = document.querySelector('.nav__cart__details');
        const footer = cartDetails.querySelector('.nav__cart__row--footer');
        const emptyMessage = document.querySelector('.nav__cart__width-container');
        const counter = document.querySelector('.nav__cart-badge');
        counter.textContent = this.getTotalQuantity();

        if (this.cart.length > 0) {
            emptyMessage.classList.remove('empty');
            counter.classList.add('d-block');
            this.cart.forEach((cartElement, index) => {
                let cartItem = cartDetails.querySelectorAll('.nav__cart__row--product')[index];
                if (!cartItem) {
                    cartItem = document.createElement('div');
                    cartItem.classList.add('nav__cart__row', 'nav__cart__row--product');
                    cartDetails.insertBefore(cartItem, footer);
                }
                cartItem.innerHTML = `
                    <div class="nav__cart__cell" data-navbar-cart-name>${cartElement.name}</div>
                    <div class="nav__cart__cell">
                        <div class="qnt-counter qnt-counter--small qnt-counter--inline">
                            <button type="button" class="qnt-counter__button  qnt-counter__button--minus" data-navbar-cart-minus>-</button>
                            <input type="text" class="qnt-counter__input" value="${cartElement.quantity}" disabled data-navbar-cart-quantity>
                            <button type="button" class="qnt-counter__button  qnt-counter__button--plus" data-navbar-cart-plus>+</button>
                        </div>
                    </div>
                    <div class="nav__cart__cell" data-navbar-cart-price>
                        <div class="old-price" style="display: none"><span>${cartElement.old_price}</span><span class="currency">&nbsp;${this.currency}</span></div>
                        <div class="new-price"><span>${cartElement.price * cartElement.quantity}</span><span class="currency">&nbsp;${this.currency}</span></div>
                    </div>
                    <div class="nav__cart__cell"><button class="nav__cart__remove" data-id="${cartElement.id}" data-navbar-cart-remove></button></div>
                `;
                let minusButton = cartItem.querySelector('.qnt-counter__button--minus');
                if (cartElement.quantity <= 1) {
                    minusButton.disabled = true;
                } else {
                    minusButton.disabled = false;
                }
            });

            const currentCartItems = cartDetails.querySelectorAll('.nav__cart__row--product');
            if (currentCartItems.length > this.cart.length) {
                for (let i = this.cart.length; i < currentCartItems.length; i++) {
                    currentCartItems[i].remove();
                }
            } 
        } else {
            emptyMessage.classList.add('empty');
            counter.classList.remove('d-block');
        }
    }
    

    getTotalPrice() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    getTotalQuantity() {
        return this.cart.reduce((total, item) => total + item.quantity, 0);
    }

    updateCartSummary() {
        const totalQuantityElement = document.querySelector('#cart-quantity');
        const oldPriceElement = document.querySelector('#cart-old-price span');
        const newPriceElement = document.querySelector('#cart-new-price span');

        totalQuantityElement.textContent = this.getTotalQuantity();
        newPriceElement.textContent = this.getTotalPrice();
    }
}

const cartInstance = new Cart();