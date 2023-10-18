export class Cart {
    constructor(currency) {
        this.currency = currency;
        this.cart = this.loadCart();
        this.updateCartView();
        this.updateSummaryView();
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
        this.updateSummaryView();
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
        this.updateSummaryView();
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
                this.updateSummaryView();
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
                    this.updateSummaryView();
                }
            }
        });
    }

    addSummaryEventListeners() {
        const summaryContainer = document.querySelector('.cart-summary__wrapper');
        if(!summaryContainer) return;
    
        summaryContainer.querySelectorAll('.qnt-counter__button--plus').forEach(button => {
            button.addEventListener('click', (e) => {
                const productDiv = e.target.closest('.cart-summary__product');
                const input = productDiv.querySelector('.qnt-counter__input');
                const id = productDiv.getAttribute('data-id');  // убедитесь, что у вас есть атрибут data-id у div с классом cart-summary__product
                const quantity = parseInt(input.value, 10) + 1;
                this.updateQuantity(id, null, quantity);  // обновление количества
            });
        });
    
        summaryContainer.querySelectorAll('.qnt-counter__button--minus').forEach(button => {
            button.addEventListener('click', (e) => {
                const productDiv = e.target.closest('.cart-summary__product');
                const input = productDiv.querySelector('.qnt-counter__input');
                const id = productDiv.getAttribute('data-id');  // убедитесь, что у вас есть атрибут data-id у div с классом cart-summary__product
                const quantity = Math.max(1, parseInt(input.value, 10) - 1);  // кол-во не может быть меньше 1
                this.updateQuantity(id, null, quantity);  // обновление количества
            });
        });
    
        summaryContainer.querySelectorAll('.cart-summary__button').forEach(button => {
            button.addEventListener('click', (e) => {
                const productDiv = e.target.closest('.cart-summary__product');
                const id = productDiv.getAttribute('data-id');  // убедитесь, что у вас есть атрибут data-id у div с классом cart-summary__product
                this.removeProduct(id, null);  // удаление продукта
            });
        });
    }
    

    updateSummaryView() {
        const summaryContainer = document.querySelector('.cart-summary__wrapper');
        if(!summaryContainer) return;
    
        summaryContainer.innerHTML = '';  // очистка контейнера сводки
    
        if (this.cart.length > 0) {
            this.cart.forEach(cartElement => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('cart-summary__product');
    
                productDiv.innerHTML = `
                    <div class="cart-summary__image">
                        <img src="https://placehold.co/60x95">
                    </div>
                    <div class="cart-summary__details">
                        <div class="cart-summary__name">${cartElement.name}</div>
                        <div class="cart-summary__quantity">
                            <div class="qnt-counter qnt-counter--relative qnt-counter--btn-small">
                                <button type="button" class="qnt-counter__button qnt-counter__button--minus" js-cart-summary-minus="" ${cartElement.quantity <= 1 ? 'disabled' : ''} data-type="product">-</button>
                                <input type="text" class="qnt-counter__input" value="${cartElement.quantity}" js-cart-summary-quantity="" data-type="product">
                                <button type="button" class="qnt-counter__button qnt-counter__button--plus" js-cart-summary-plus="" data-type="product">+</button>
                            </div>
                        </div>
                        <div class="cart-summary__price">
                            <div class="old-price">${cartElement.old_price}</div>
                            <div class="new-price">${cartElement.price * cartElement.quantity}</div>
                        </div>
                        <div class="cart-summary__remove">
                            <button type="button" class="cart-summary__button" js-cart-summary-remove="" data-type="product"></button>
                        </div>
                    </div>
                `;

  
                summaryContainer.appendChild(productDiv);
            });
            this.addSummaryEventListeners();
        } else {
            // Отображение сообщения о пустой корзине или другой логики
        }
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