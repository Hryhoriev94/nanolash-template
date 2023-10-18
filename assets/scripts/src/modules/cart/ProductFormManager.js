import { AddToCartForm } from "./AddToCartForm";
import { VariantForm } from "./VariantForm";
import { CurrencyManager } from './CurrencyManager'

export class ProductFormManager {
    constructor(cartInstance) {
        this.productForms = document.querySelectorAll('.product-form');
        this.cartInstance = cartInstance;
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

                const addToCartFormInstance = new AddToCartForm(this.cartInstance, addToCartBlock, currency, variantFormInstance);

                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                });
            });
        }).catch(error => {
            console.error('Error:', error);
        });
    }
}