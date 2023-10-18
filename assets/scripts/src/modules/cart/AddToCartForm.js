import {AjaxHelper} from '../ajaxHelper';

export class AddToCartForm {
    constructor(cartInstance, addToCartBlock, currency, variantForm) {
        this.eventsAttached = false;
        this.addToCartBlock = addToCartBlock;
        this.plus = this.addToCartBlock.querySelector('.add-to-cart__plus');
        this.minus = this.addToCartBlock.querySelector('.add-to-cart__minus');
        this.quantity = this.addToCartBlock.querySelector('.qnt-counter__input') || 
        this.addToCartBlock.querySelector('input.add-to-cart__quantity');
        this.customSelect = addToCartBlock.querySelector('.add-to-cart__select');
        this.newPrice = this.addToCartBlock.querySelector('.new-price .sum');
        this.oldPrice = this.addToCartBlock.querySelector('.old-price .sum');
        this.customSelectClass = null;
        this.cartInstance = cartInstance;
        if(!this.customSelect) {
            this.alias = this.addToCartBlock.getAttribute('data-alias') || 
            this.addToCartBlock.querySelector('[data-alias]').getAttribute('data-alias');
            if(document.querySelector('[data-product-name]')) {
                this.productName = document.querySelector('[data-product-name]').getAttribute('data-product-name')
            } else {
                this.productName = this.addToCartBlock.closest('.products__item').getAttribute('data-product-name-current');
            }
        } else {
            this.alias = [];
            this.customSelect.querySelectorAll('.option').forEach(option => {
                this.alias.push(option.getAttribute('data-alias'));
            })
            this.productName = this.customSelect.querySelector('.current').textContent
        }       
        this.currency = currency;
        this.name = this.add
        this.variantForm = variantForm;
        
        this.init();
    }

    async init() {
        if (this.customSelect) {
            this.alias = this.alias[0]
            this.customSelectInstance = new CustomSelect(this.customSelect);
            this.updatePriceBasedOnSelect();
            this.customSelectInstance.options.forEach(option => {
                option.addEventListener('click', () => {
                    this.updatePriceBasedOnSelect();
                });
            });
        } else {
            this.product = await this.getData();
            this.price = this.product['price'][this.currency];
            this.productId = this.product['id'];
            this.listeners();
            this.initPrice();
        }
    }
    

    async updatePriceBasedOnSelect() {
        if (!this.customSelect) return;
            this.alias = this.customSelectInstance.activeOption.getAttribute('data-alias');
            this.product = await this.getData();
            this.productName = this.customSelectInstance.activeOption.textContent;
            this.price = this.product['price'][this.currency];
            this.productId = this.product['id'];
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
        if(this.getQuantity() > 1) {
            this.minus.disabled = false;
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

        this.cartInstance.addProduct({
            id: comboid,
            name: name,
            price: this.price,
            quantity: this.getQuantity(),
            currency: this.cartInstance.getCurrency(),
        });
        this.cartInstance.updateCartView();
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