import cart from './modules/cart.js';
import navbarActions from './modules/navbarActions.js';
import { Grid } from './modules/gridData.js';



window.addEventListener('load', () => {
    cart();
    navbarActions();
    new Grid();
})