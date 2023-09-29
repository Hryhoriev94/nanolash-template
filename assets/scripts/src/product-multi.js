import { heroimage } from './modules/heroimage.js'
// import { Slider } from './modules/customers-opinions.js';
import { adjustFontSize } from './modules/adjustFontSize.js';
// import { effectBeforeAfterHandler } from './modules/effectBeforeAfter.js';
import { parallax } from './modules/parallax.js';

window.addEventListener('load', () => {
    heroimage();
    // const sliders = document.querySelectorAll('.customers-opinions');
    // sliders.forEach(sliderElement => {
    //     new Slider(sliderElement);
    // });

    adjustFontSize();
    window.addEventListener('resize', () => {
        adjustFontSize();
        parallax();
    });

    // effectBeforeAfterHandler();
    window.addEventListener('scroll', () => {
        parallax();
    }, {passive: true});
   
})