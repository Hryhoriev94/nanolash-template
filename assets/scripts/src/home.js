import { faq } from './modules/faq.js'
import cart from './modules/cart.js';
import navbarActions from './modules/navbarActions.js';
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
    faq();
    navbarActions();
    homePageTitleHandler();
    window.addEventListener('resize', () => {
        homePageTitleHandler();
    });
});