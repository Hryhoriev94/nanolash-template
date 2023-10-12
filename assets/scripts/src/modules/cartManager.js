import { AjaxHelper } from './ajaxHelper.js';

let cartInstance;

class CurrencyManager {
    static setCurrency(currency) {
        localStorage.setItem('currency', currency);
    }
    static getCurrency() {
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
}

class CartManager {
    constructor() {
        this.cartButton = document.querySelector('[data-cart__button]');
        this.cartComponent = document.querySelector('.nav__cart');
        this.init();
    }

    init() {
        this.cartButton.addEventListener('click', this.toggleCart.bind(this));
        document.addEventListener('click', this.closeCartIfClickedOutside.bind(this));
        this.cartComponent.addEventListener('click', this.preventEventBubbling.bind(this));
    }

    toggleCart(event) {
        event.stopPropagation();  // Предотвращаем всплытие события до document
        this.cartComponent.classList.toggle('d-flex');
    }

    preventEventBubbling(event) {
        event.stopPropagation();  // Предотвращаем всплытие события до document
    }

    closeCartIfClickedOutside(event) {
        // Проверяем, не является ли элемент иконкой корзины, и не содержится ли цель события в cartComponent
        if (event.target !== this.cartButton && !this.cartComponent.contains(event.target)) {
            this.cartComponent.classList.remove('d-flex');
        }
    }
}

class ProductFormManager {
    constructor() {
        this.productForms = document.querySelectorAll('.product-form');
        this.init();
    }

    init() {
        CurrencyManager.getCurrency().then(currency => {
            this.productForms.forEach(form => {
                const variantFormElement = form.querySelector('.product__variants');
                const addToCartBlock = form.querySelector('.add-to-cart') || form;
                let variantFormInstance;
                if (variantFormElement) {
                    variantFormInstance = new VariantForm(variantFormElement);
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
}

class AddToCartForm {
    constructor(addToCartBlock, currency, variantForm) {
        this.eventsAttached = false;
        this.addToCartBlock = addToCartBlock;
        this.alias = this.addToCartBlock.getAttribute('data-alias') || 
        this.addToCartBlock.querySelector('[data-alias]').getAttribute('data-alias');
        this.plus = this.addToCartBlock.querySelector('.add-to-cart__plus');
        this.minus = this.addToCartBlock.querySelector('.add-to-cart__minus');
        this.quantity = this.addToCartBlock.querySelector('.qnt-counter__input') || 
        this.addToCartBlock.querySelector('input.add-to-cart__quantity');
        this.newPrice = this.addToCartBlock.querySelector('.new-price .sum');
        this.oldPrice = this.addToCartBlock.querySelector('.old-price .sum');
        if(document.querySelector('[data-product-name]')) {
            this.productName = document.querySelector('[data-product-name]').getAttribute('data-product-name')
        } else {
            this.productName = this.addToCartBlock.closest('.products__item').getAttribute('data-product-name-current');
        }        
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
        this.oldPrice.textContent = this.getQuantity() * this.price * 1.2;
    }

    calculateSum() {
        this.summary = this.getQuantity() * this.price;
        this.newPrice.textContent = this.summary;
    }

    getQuantity() {
        return parseInt(this.quantity.value, 10);
    }

    listeners() {
        if (this.eventsAttached) return;
        this.plus.addEventListener('click', this.plusHandler.bind(this));
        this.minus.addEventListener('click', this.minusHandler.bind(this));
        this.quantity.addEventListener('input', this.inputHandler.bind(this));

        const addToCartButton = this.addToCartBlock.querySelector('.add-to-cart__button');
        addToCartButton.addEventListener('click', this.addToCartHandler.bind(this));

        this.eventsAttached = true;
    }

    addToCartHandler() {
        let variantId = this.variantForm ? this.variantForm.variantId : null;
        let comboid = variantId ? `${this.productId}-${variantId}` : this.productId;
        let name = '';
        if(!this.variantForm) {
            variantId = null;
            comboid = this.productId;
            name = `<span class="product-name"><strong>${this.productName}</strong><span>`;
            
        } else {
            variantId = this.variantForm.variantId;
            comboid = `${this.productId}-${variantId}`;
            name = `<span class="product-name-margin"><strong>${this.productName}</strong><span>`;
            name += ' ' + `<small>${this.variantForm.variantName}</small>`
        }

        cartInstance.addProduct({
            id: comboid,
            name: name,
            price: this.price,
            quantity: this.getQuantity(),
            currency: cartInstance.getCurrency(),
        });
        cartInstance.updateCartView();
    }

    async getData() {
        const variantId = this.variantForm ? this.variantForm.variantId : null;
        try {
            const data = await AjaxHelper.fetchData('/getData.php', { alias: this.alias });
            if (data && !data.error) {
                return data.product;
            } else {
                console.error('Product not found', data.error);
                return null;
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
        this.variantName = '';
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

    updateProductName(name) {
        let newName = ''
        name.forEach(option => {
            let title = option.type;
            newName+= `${title.charAt(0).toUpperCase() + title.slice(1).toLowerCase()}:&nbsp;${option.value} `;
        });

        this.variantName = newName;
    }

    searchActiveVariants() {
        const arr = [];
        const name = [];
        this.rows.forEach(row => {
            const active = row.querySelector('.product__variant__block.active');
            if (active) {
                name.push({
                    type: row.previousElementSibling.textContent,
                    value: active.textContent
                });
                arr.push(active);
            }
        });
        this.updateProductName(name);
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
    constructor(currency) {
        this.currency = currency;
        this.cart = this.loadCart();
        this.updateCartView();
        this.addEventListeners();
    }

    static async createInstance() {
        const currency = await Cart.fetchCurrency();
        return new Cart(currency);
    }

    static async fetchCurrency() {
        const sendData = window.location.hostname;
        try {
            const response = await fetch('/getData.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `domain=${sendData}`
            });
            const data = await response.json();
            if (data.currency) {
                localStorage.setItem('currency', data.currency);
                return data.currency;
            } else {
                throw new Error('Currency not found');
            }
        } catch (error) {
            console.error('Error fetching currency:', error);
            throw error;
        }
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

export const cart = async () => {
    cartInstance = await Cart.createInstance();
    new CartManager();
    new ProductFormManager();
    document.addEventListener('click', CartManager.closeCartIfClickedOutside);
}

