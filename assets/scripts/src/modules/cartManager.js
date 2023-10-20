import { Cart } from "./cart/Cart";
import { ProductFormManager } from "./cart/ProductFormManager";
let cartInstance;



class CartManager {
    constructor(cartInstance) {
        this.cartInstance = cartInstance;
        this.cartButton = document.querySelector('[data-cart__button]');
        this.cartComponent = document.querySelector('.nav__cart');
        this.productsName = JSON.parse(document.querySelector('#products-name').textContent);

        this.init();
    }

    async init() {
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

export const cart = async (cartManagerInstance) => {
    cartInstance = await Cart.createInstance();
    cartManagerInstance = new CartManager(cartInstance);
    new ProductFormManager(cartInstance);
}

