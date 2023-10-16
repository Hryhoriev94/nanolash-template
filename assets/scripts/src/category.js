import { cart } from './modules/cartManager.js';
import navbarActions from './modules/navbarActions.js';
import { Grid } from './modules/gridData.js';
import { adjustFontSize } from './modules/adjustFontSize.js';
import { SocialSlider } from './modules/socialsSlider.js';

window.addEventListener('load', () => {
    cart();
    adjustFontSize();
    navbarActions();
    new Grid();
    new SocialSlider();
})