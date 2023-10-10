import { faq } from './modules/faq.js'
import cart from './modules/cart.js';
import navbarActions from './modules/navbarActions.js';
import { SocialSlider } from './modules/socialsSlider.js';
import { Grid } from './modules/gridData.js';
const homePageTitleHandler = () => {
    const titleSection = document.querySelector('#home-page-title');
    const width = window.innerWidth;
    if(width >= 768) {
        document.querySelector('.hero').prepend(titleSection)
    } else {
        document.querySelector('main').prepend(titleSection)
    }
}

window.addEventListener('load', () => {
    cart();
    new Grid();
    faq();
    navbarActions();
    homePageTitleHandler();
    new SocialSlider();
    window.addEventListener('resize', () => {
        homePageTitleHandler();
    });
});