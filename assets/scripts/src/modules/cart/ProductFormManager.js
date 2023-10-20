import { AddToCartForm } from "./AddToCartForm";
import { VariantForm } from "./VariantForm";

export class ProductFormManager {
    constructor(cartInstance) {
        this.productForms = document.querySelectorAll('.product-form');
        this.cartInstance = cartInstance;
        this.init();
    }

    createAddToCartFormInstance(form, variantFormInstance) {
        const addToCartBlock = form.querySelector('.add-to-cart') || form;
        return new AddToCartForm(this.cartInstance, addToCartBlock,  variantFormInstance);
    }

    init() {
        this.productForms.forEach(form => {
            const variantFormElement = form.querySelector('.product__variants');
            let variantFormInstance;
            if (variantFormElement) {
                variantFormInstance = new VariantForm(variantFormElement);
            }
            const addToCartFormInstance = this.createAddToCartFormInstance(form, variantFormInstance);

        });
    }
}