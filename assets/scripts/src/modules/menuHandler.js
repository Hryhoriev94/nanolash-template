import { debounce } from "./debounce";

export class Menu {
    constructor() {
        this.menuButtonHamburger = document.querySelector('[data-js-hamburger]');
        this.menuButton = document.querySelector('[data-menu-button]');
        this.menu = document.querySelector('#menu');
        this.menuElementsBlocks = document.querySelectorAll('.menu-element-container');
        this.navbar = document.querySelector('[data-js-navbar]');
        this.menuElements = this.menu.querySelectorAll('.menu-element.links');
        this.isOpen = false;
        this.scrollPosition = 0;
        this.navbarHeight = this.navbar.offsetHeight;
        this.init();
    }
    init() {
        window.addEventListener('scroll', debounce(() => {
            console.log(1);
            this.handleScroll();
        }, 20));

        document.addEventListener('click', (e) => {
            if (window.innerWidth >= 992 && 
                !this.menu.contains(e.target) && 
                e.target !== this.menuButton &&
                !this.menuButton.contains(e.target) && 
                this.isOpen) {
                this.closeMenu();
            }
            if(window.innerWidth >= 992 && e.target === this.menuButton) {
                this.clickBurgerHandler();
            }
        });

        this.menuElements.forEach(element => {
            element.addEventListener('click', () => {
                if(element.classList.contains('links-open')) {
                    this.closeSubmenu(element)
                } else {
                    this.openSubmenu(element)
                }
            })
        });

        

        this.menuButtonHamburger.addEventListener('click', () => {
            this.clickBurgerHandler();
        })
        window.addEventListener('resize', () => {
            this.calcNavbarHeight();
            this.menu.style.top = `${this.navbarHeight}px`;
            this.ajustMenuElementsService();
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

    handleScroll() {
        const previousHeight = this.navbarHeight; // сохраняем предыдущую высоту
        this.calcNavbarHeight(); 
        const top = this.navbarHeight;
        this.menu.style.top = `${top}px`;
    
        setTimeout(() => {
            if (previousHeight !== this.navbarHeight) { // сравниваем с новой высотой
                this.handleScroll();
            }
        }, 300);
    }

    calcNavbarHeight() {
        this.navbarHeight = this.navbar.offsetHeight;
    }

    clickBurgerHandler() {
        if(!this.isOpen) {
            this.openMenu();
        } else {
            this.closeMenu();
        }
    }

    openMenu() {
        this.scrollPosition = document.documentElement.scrollTop;
        document.body.classList.add('menu-open');
        this.menuButtonHamburger.classList.remove('hamburger--close');
        this.menuButtonHamburger.classList.add('hamburger--open');
        this.menu.style.top = `${this.navbarHeight}px`;
        this.menu.classList.remove('close');
        this.menu.classList.add('animation-open');
        document.body.style.top = `-${this.scrollPosition}px`;
        this.menu.addEventListener('animationend', () => {
            this.menu.classList.add('open');
            this.menu.classList.remove('animation-open');
            this.menu.classList.remove('close');
        });
        this.ajustMenuElementsService();
        this.isOpen = true;
    }



    closeMenu() {
        document.body.classList.remove('menu-open')
        this.menuButtonHamburger.classList.remove('hamburger--open');
        this.menuButtonHamburger.classList.add('hamburger--close');
        this.menu.classList.add('animation-close');
        window.scrollTo(0, this.scrollPosition);
        this.menu.addEventListener('animationend', () => {
            this.menu.classList.add('close');
            this.menu.classList.remove('animation-close');
            this.menu.classList.remove('open')
        });
        this.isOpen = false;
    }

    adjustMenuElements() {
        const elements = this.menuElementsBlocks;
        for (let i = 3; i < elements.length; i += 3) {
            const thisGroup = [elements[i], elements[i + 1], elements[i + 2]];
            const prevGroup = [elements[i - 3], elements[i - 2], elements[i - 1]];

            console.log(prevGroup);

            let maxHeight = Math.max(
                ...prevGroup.map(el => el ? el.offsetHeight : 0)
            );
            

            thisGroup.forEach((el, index) => {
                if (el) {
                    const heightTopElement =  elements[i - 3 + index].offsetHeight;
                    const difference = maxHeight - heightTopElement;
                    el.style.top = -difference + 'px';
                }
            });
        }
    }

    unsetAjustMenuElements() {
        const elements = this.menuElementsBlocks;
        elements.forEach(element => {
            element.removeAttribute('style');
        })
    }

    ajustMenuElementsService() {
        if(window.innerWidth >= 992) {
            this.adjustMenuElements();
        } else {
            this.unsetAjustMenuElements();
        }
    }
}