export class Menu {
    constructor() {
        this.menuButton = document.querySelector('[data-js-hamburger]');
        this.menu = document.querySelector('#menu');
        this.navbar = document.querySelector('[data-js-navbar]');
        this.menuElements = this.menu.querySelectorAll('.menu-element.links');
        this.isOpen = false;
        this.scrollPosition = 0;
        this.navbarHeight = this.navbar.offsetHeight;
        this.init();
    }
    init() {

        this.menuElements.forEach(element => {
            element.addEventListener('click', () => {
                if(element.classList.contains('links-open')) {
                    this.closeSubmenu(element)
                } else {
                    this.openSubmenu(element)
                }
            })
        });

        this.menuButton.addEventListener('click', () => {
            this.clickBurgerHandler();
        })
        window.addEventListener('resize', () => {
            this.calcNavbarHeight();
        })
    }

    closeSubmenu(element) {
        const container = element.closest('.menu-element-container');
        const submenu = container.querySelector('.menu-element__links');
        if(!submenu.classList.contains('open')) {
            return
        }
        const currentHeight = submenu.scrollHeight;

        // Устанавливаем текущую высоту в px, чтобы была начальная точка для анимации
        submenu.style.maxHeight = `${currentHeight}px`;

        requestAnimationFrame(() => {
        // Устанавливаем max-height обратно в 0, чтобы начать анимацию
        submenu.style.maxHeight = '0px';
        
        submenu.addEventListener('transitionend', () => {
            submenu.classList.remove('open');
            submenu.removeAttribute('style');
        }, { once: true });  // Обработчик будет удален после первого срабатывания
    });
    

    element.classList.remove('links-open');
    element.classList.add('links-close');
    }

    openSubmenu(element) {
        this.menuElements.forEach(otherElement => {
            this.closeSubmenu(otherElement)
        }) 
        const container = element.closest('.menu-element-container');
        const submenu = container.querySelector('.menu-element__links');
        submenu.classList.add('animate');
        const submenuElements = submenu.querySelectorAll('.menu-element--subelement');
        let height = 0;
        submenuElements.forEach(subElement => {
            height += subElement.offsetHeight
        });
        submenu.style.maxHeight = height + 'px';
        submenu.addEventListener('transitionend', () => {
            submenu.classList.add('open');
            submenu.classList.remove('animate');
            submenu.removeAttribute('style');
        })
        element.classList.remove('links-close');
        element.classList.add('links-open');
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