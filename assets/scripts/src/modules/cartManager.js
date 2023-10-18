import { Cart } from "./cart/Cart";
import { ProductFormManager } from "./cart/ProductFormManager";
let cartInstance;



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

export const cart = async () => {
    cartInstance = await Cart.createInstance();
    const cartManagerInstance = new CartManager();
    new ProductFormManager(cartInstance);
    document.addEventListener('click', cartManagerInstance.closeCartIfClickedOutside.bind(cartManagerInstance));
}

