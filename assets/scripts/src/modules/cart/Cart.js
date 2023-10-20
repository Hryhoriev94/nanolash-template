export class Cart {
    constructor(products, currency) {
        this.cart = this.loadCart();
        this.products = products;
        this.currency = currency;
        this.init();
    }

    async init() {
        this.updateCartView();
        this.updateSummaryView();
        this.addEventListeners();
        this.addSummaryEventListeners();
    }


    static async createInstance() {
        const data = await Cart.getAllData();
        this.currency = data.currency;
        this.products = data.products;
        return new Cart(this.products, this.currency);
    }

    returnAllData() {
        return this.products;
    }



    static async getAllData() {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/getData.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        resolve(response);
                    } catch (error) {
                        reject('Error parsing JSON response: ' + error.message);
                    }
                }
            };
    
            xhr.onerror = function () {
                reject('Network error');
            };
    
            xhr.send('getAllData=true');
        });
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
    
        // Удаление старых обработчиков
        summaryContainer.querySelectorAll('.qnt-counter__button, .cart-summary__button').forEach(button => {
            const oldElement = button;
            const newElement = oldElement.cloneNode(true);
            oldElement.parentNode.replaceChild(newElement, oldElement);
        });
    
        summaryContainer.querySelectorAll('.qnt-counter__button--plus').forEach(button => {
            button.addEventListener('click', (e) => {
                const productDiv = e.target.closest('.cart-summary__product');
                const id = productDiv.getAttribute('data-id');
                const input = productDiv.querySelector('.qnt-counter__input');
                const minusButton =  productDiv.querySelector('.qnt-counter__button--minus');
                const addedProduct = this.cart.find(element => element.id == id);
                addedProduct.quantity++;
                input.value = addedProduct.quantity;
                if(input.value > 1) {
                    minusButton.removeAttribute('disabled');
                }
                this.saveCart();
                this.updateCartView();
                this.updateSummaryView();
            });
        });
    
        summaryContainer.querySelectorAll('.qnt-counter__button--minus').forEach(button => {
            button.addEventListener('click', (e) => {
                const productDiv = e.target.closest('.cart-summary__product');
                const id = productDiv.getAttribute('data-id');
                const input = productDiv.querySelector('.qnt-counter__input');
                const addedProduct = this.cart.find(element => element.id == id);
                addedProduct.quantity--;
                input.value = addedProduct.quantity;
                if(input.value == 1) {
                    button.setAttribute('disabled', true);
                }
                this.saveCart();
                this.updateCartView();
                this.updateSummaryView();
            });
        });
    
        summaryContainer.querySelectorAll('.cart-summary__button').forEach(button => {
            button.addEventListener('click', (e) => {
                const productDiv = e.target.closest('.cart-summary__product');
                const id = productDiv.getAttribute('data-id');
                this.removeProduct(id, null);
                productDiv.remove();
            });
        });
    }

    getName(alias, cartElement) {
        const names = JSON.parse(document.querySelector('#products-name').textContent);

        let name = `<strong>${names[alias]?.name}</strong>`;
        if(names[alias].variants && names[alias].variants_data) {
            let variantString = '';
            cartElement.variants.forEach((variant, index) => {
                variantString += `<small>${names[alias].variants[index]}:&nbsp;${names[alias].variants_data[index][variant]}</small> `;
            })
            
            name += `<div>${variantString}</div>`;
        } 

        return name;
    }
    
    
    updateSummaryView() {
        const summaryContainer = document.querySelector('.cart-summary__wrapper');
        if (!summaryContainer) return;
        const sumBlock = document.querySelector('#cart-summary__result');
        summaryContainer.querySelectorAll('.cart-summary__product').forEach(existingProductDiv => {
            const existingId = existingProductDiv.getAttribute('data-id');
            const cartItem = this.cart.find(item => item.id == existingId);
            if (!cartItem) {
                existingProductDiv.remove();
            }
        });
    
        this.cart.forEach(cartElement => {
            let productData = {};
            for (const productAlias in this.products) {
                if (this.products[productAlias].id == cartElement.id || this.products[productAlias].id == cartElement.baseId) {
                    productData.alias = productAlias;
                    productData.data = this.products[productAlias];
                    break;
                }
            }
            if (!productData.data) {
                console.error(`Product data not found for id: ${cartElement.id}`);
                return;
            }
    
            const name = this.getName(productData.alias, cartElement);
    
            const existingProductDiv = summaryContainer.querySelector(`.cart-summary__product[data-id="${cartElement.id}"]`);
            if (existingProductDiv) {
                // Обновление существующего продукта
                existingProductDiv.querySelector('.qnt-counter__input').value = cartElement.quantity;
                existingProductDiv.querySelector('.old-price span').textContent = productData.data.price * cartElement.quantity;
                existingProductDiv.querySelector('.new-price span').textContent = productData.data.price * cartElement.quantity;
            } else {
                // Добавление нового продукта
                const productDiv = document.createElement('div');
                productDiv.classList.add('cart-summary__product');
                productDiv.setAttribute('data-id', cartElement.id);
                productDiv.innerHTML = `
                <div class="cart-summary__image">
                    <img src="https://placehold.co/60x95">
                </div>
                <div class="cart-summary__details">
                    <div class="cart-summary__name">${name}</div>
                    <div class="cart-summary__quantity">
                        <div class="qnt-counter qnt-counter--relative qnt-counter--btn-small">
                            <button type="button" class="qnt-counter__button qnt-counter__button--minus" js-cart-summary-minus="" ${cartElement.quantity <= 1 ? 'disabled' : ''} data-type="product">-</button>
                            <input type="text" class="qnt-counter__input" value="${cartElement.quantity}" js-cart-summary-quantity="" data-type="product">
                            <button type="button" class="qnt-counter__button qnt-counter__button--plus" js-cart-summary-plus="" data-type="product">+</button>
                        </div>
                    </div>
                    <div class="cart-summary__price">
                        <div class="old-price">
                            <span>${productData.data.price * cartElement.quantity}</span>
                            <span>${this.currency}</span>
                        </div>
                        <div class="new-price">
                            <span>${productData.data.price * cartElement.quantity}</span>
                            <span>${this.currency}</span>
                        </div>
                    </div>
                    <div class="cart-summary__remove">
                        <button type="button" class="cart-summary__button" js-cart-summary-remove="" data-type="product"></button>
                    </div>
                </div>
                `;
    
                summaryContainer.appendChild(productDiv);
            }
        });
        this.addSummaryEventListeners();
        sumBlock.textContent = `${this.getTotalPrice()} ${this.currency}`
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
                let productData = {};
                for(const productAlias in this.products) {
                    if(this.products[productAlias].variants) {
                        if(this.products[productAlias].id == cartElement.baseId) {
                            productData.alias = productAlias;
                            productData.data = this.products[productAlias];
                        }
                    }
                    if(this.products[productAlias].id == cartElement.id) {
                        productData.alias = productAlias;
                        productData.data = this.products[productAlias];
                    }
                }
                const name = this.getName(productData.alias, cartElement);
                let cartItem = cartDetails.querySelectorAll('.nav__cart__row--product')[index];
                if (!cartItem) {
                    cartItem = document.createElement('div');
                    cartItem.classList.add('nav__cart__row', 'nav__cart__row--product');
                    cartDetails.insertBefore(cartItem, footer);
                }
                cartItem.innerHTML = `
                    <div class="nav__cart__cell" data-navbar-cart-name>${name}</div>
                    <div class="nav__cart__cell">
                        <div class="qnt-counter qnt-counter--small qnt-counter--inline">
                            <button type="button" class="qnt-counter__button  qnt-counter__button--minus" data-navbar-cart-minus>-</button>
                            <input type="text" class="qnt-counter__input" value="${cartElement.quantity}" disabled data-navbar-cart-quantity>
                            <button type="button" class="qnt-counter__button  qnt-counter__button--plus" data-navbar-cart-plus>+</button>
                        </div>
                    </div>
                    <div class="nav__cart__cell" data-navbar-cart-price>
                        <div class="old-price" style="display: none"><span>${productData.data.price}</span><span class="currency">&nbsp;${this.currency}</span></div>
                        <div class="new-price"><span>${productData.data.price * cartElement.quantity}</span><span class="currency">&nbsp;${this.currency}</span></div>
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
        let totalCost = 0;
        this.cart.forEach(cartItem => {
            const id = cartItem.baseId ? cartItem.baseId : cartItem.id;
            const productData = this.products[Object.keys(this.products).find(key => this.products[key].id === id)];
            if (productData) {
                totalCost += cartItem.quantity * productData.price;
            }
        });
        return totalCost;
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