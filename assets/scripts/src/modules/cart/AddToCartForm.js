import {CustomSelect} from '../customSelect';
export class AddToCartForm {firstOption
    constructor(cartInstance, addToCartBlock, variantForm) {
        this.initializeProperties(cartInstance, addToCartBlock, variantForm);
        this.init();

    }

    initializeProperties(cartInstance, addToCartBlock, variantForm) {
        this.eventsAttached = false;
        this.addToCartBlock = addToCartBlock;
        this.cartInstance = cartInstance;
        this.currency = this.cartInstance.currency;
        this.variantForm = variantForm;
        this.assignElements();
        this.assignProductDetails();
    }

    assignElements() {
        this.plus = this.find('.add-to-cart__plus');
        this.minus = this.find('.add-to-cart__minus');
        this.quantity = this.find('.qnt-counter__input') || this.find('input.add-to-cart__quantity');
        this.customSelect = this.find('.add-to-cart__select');
        this.newPrice = this.find('.new-price .sum');
        this.oldPrice = this.find('.old-price .sum');
    }

    assignProductDetails() {
        this.alias = this.addToCartBlock.getAttribute('data-alias')
        this.product = this.cartInstance.products[this.alias];
    }

    find(selector) {
        return this.addToCartBlock.querySelector(selector);
    }

    init() {
        if (this.customSelect) {
            this.initializeWithCustomSelect();
        } else {
            this.initializeWithoutCustomSelect();
        }
    }
    
    initializeWithCustomSelect() {
        this.customSelectInstance = new CustomSelect(this.customSelect);
        this.updatePriceBasedOnSelect();
        this.customSelectInstance.options.forEach(option => {
            option.addEventListener('click', () => this.updatePriceBasedOnSelect());
        });
    }

    initializeWithoutCustomSelect() {
        this.listeners();
        this.initPrice();
    }

    updatePriceBasedOnSelect() {
        if (!this.customSelect) return;
        this.alias = this.customSelectInstance.activeOption.getAttribute('data-alias');
        this.product = this.cartInstance.products[this.alias];
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
        this.price = this.product.price;
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
        this.plus.addEventListener('click', () => this.plusHandler());
        this.minus.addEventListener('click', () => this.minusHandler());
        this.quantity.addEventListener('input', () => this.inputHandler());
        const addToCartButton = this.find('.add-to-cart__button');
        addToCartButton.addEventListener('click', () => this.addToCartHandler());
        this.eventsAttached = true;
    }

    addToCartHandler() {
        this.id = this.product.id;
        this.type = this.cartInstance.products[this.alias].type;
        if(this.product.variants) {
            this.variantID = `${this.id}-${this.variantForm.variantId}`;
            this.cartInstance.addProduct({
                id: this.variantID,
                baseId: this.id,
                variants: this.variantForm.variantParameters,
                type: this.type,
                quantity: this.getQuantity(),
            });
        }
        else {
            this.cartInstance.addProduct({
                id: this.id,
                type: this.type,
                quantity: this.getQuantity(),
            });
        }
        this.cartInstance.updateCartView();
    }
}