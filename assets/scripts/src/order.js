import {cart} from "./modules/cartManager";
import navbarActions from "./modules/navbarActions";

window.addEventListener('load', () => {
    cart();
    navbarActions();
});