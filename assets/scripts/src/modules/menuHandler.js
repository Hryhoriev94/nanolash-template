export class Menu {
    constructor() {
        this.menuButton = document.querySelector('[data-js-hamburger]');
        this.menu = document.querySelector('#menu');
        this.navbar = document.querySelector('[data-js-navbar]');
        this.menuElements = this.menu.querySelectorAll('.menu-element');
        this.isOpen = false;
        this.scrollPosition = 0;
        this.navbarHeight = this.navbar.offsetHeight;
        this.init();
    }
    init() {
        this.menuButton.addEventListener('click', () => {
            this.clickBurgerHandler();
        })
        window.addEventListener('resize', () => {
            this.calcNavbarHeight();
        })

    }

    calcNavbarHeight() {
        this.navbarHeight = this.navbar.offsetHeight;
    }

    clickBurgerHandler() {
        this.isOpen = !this.isOpen;
        if(this.isOpen) {
            this.openMenu();
        } else {
            this.closeMenu();
        }
    }

    openMenu() {
        this.scrollPosition = document.documentElement.scrollTop;
        document.body.classList.add('menu-open');
        this.menuButton.classList.remove('hamburger--close');
        this.menuButton.classList.add('hamburger--open');
        this.menu.style.top = `${this.navbarHeight}px`;
        this.menu.classList.remove('close');
        this.menu.classList.add('animation-open');
        document.body.style.top = `-${this.scrollPosition}px`;
        this.menu.addEventListener('animationend', () => {
            this.menu.classList.add('open');
            this.menu.classList.remove('animation-open');
            this.menu.classList.remove('close');
        });
    }

    closeMenu() {
        document.body.classList.remove('menu-open')
        this.menuButton.classList.remove('hamburger--open');
        this.menuButton.classList.add('hamburger--close');
        this.menu.classList.add('animation-close');
        window.scrollTo(0, this.scrollPosition);
        this.menu.addEventListener('animationend', () => {
            this.menu.classList.add('close');
            this.menu.classList.remove('animation-close');
            this.menu.classList.remove('open')
        });
    }
}