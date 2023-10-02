export default () => {
    changeInputValueHandler();
}

const cartButtonHandler = () => {
    const cartButton = document.querySelector('[data-cart__button]');
    const cartComponent = document.querySelector('.nav__cart');
    console.log(cartButton);
    cartButton.addEventListener('click', () => {
        cartComponent.classList.toggle('d-flex');
    })
}



const getCurrency = () => {
    return new Promise((resolve, reject) => {
        const sendData = window.location.hostname.split('.').slice(-2).join('.');
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

            const addToCartFormInstance = new AddToCartForm(addToCartBlock, currency, variantFormInstance);
            
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                // Здесь вы можете использовать addToCartFormInstance и variantFormInstance
                // для получения всех необходимых данных и отправки их на сервер
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
        this.updateCartView();
    }

    loadCart() {
        const cart = localStorage.getItem('cart');
        return cart ? JSON.parse(cart) : [];
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
        this.cart = this.cart.filter(item => !(item.id === id && item.variantId === variantId));
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

    updateCartView() {
        // Здесь вы можете обновить DOM для отображения содержимого корзины
        // Например, вы можете использовать this.cart для создания HTML-элементов
    }

    getTotalPrice() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }
}

// Инициализация корзины
const cartInstance = new Cart();

// Пример удаления продукта из корзины
cartInstance.removeProduct('product1', 'red');

// Пример обновления количества продукта в корзине
cartInstance.updateQuantity('product1', 'red', 2);

// Получение общей стоимости корзины
const totalPrice = cartInstance.getTotalPrice();




