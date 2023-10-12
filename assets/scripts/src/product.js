import { heroimage } from './modules/heroimage.js'
import { Slider } from './modules/customers-opinions.js';
import { adjustFontSize } from './modules/adjustFontSize.js';
import { effectBeforeAfterHandler } from './modules/effectBeforeAfter.js';
import { parallax } from './modules/parallax.js';
import { cart } from './modules/cartManager.js';
import navbarActions from './modules/navbarActions.js';

window.addEventListener('load', () => {
    navbarActions();
    heroimage();
    const sliders = document.querySelectorAll('.customers-opinions');
    sliders.forEach(sliderElement => {
        new Slider(sliderElement);
    });
    cart();

    adjustFontSize();
    window.addEventListener('resize', () => {
        adjustFontSize();
        parallax();
    });

    effectBeforeAfterHandler();
    window.addEventListener('scroll', () => {
        parallax();
    }, {passive: true});
   
})
