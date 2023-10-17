import {Menu} from './menuHandler';
const navbarActions = () => {
    const navbar = document.querySelector('.nav');
    const nextElement = navbar.nextElementSibling; // Получение следующего элемента
  
    nextElement.classList.add('padding-top-element'); // Добавление класса
  
    modifyNavbar(navbar, nextElement);
  
    navbar.addEventListener('transitionend', () => {
      setNavbarHeightAsPadding(nextElement);
    });
  
    window.addEventListener('scroll', () => {
      modifyNavbar(navbar, nextElement);
    });
  
    window.addEventListener('resize', () => {
      modifyNavbar(navbar, nextElement);
    });

    const menu = new Menu();
  };
  
  const isScrolled = () => window.scrollY > 50;
  
  const returnPadding = () => (isScrolled() ? '10px' : '15px');
  
  const setPadding = (navbar) => {
    const padding = returnPadding();
    navbar.style.setProperty('--nav-padding', padding);
  };
  
  const setNavbarHeightAsPadding = (nextElement) => {
    const height = getNavbarHeight(nextElement.previousElementSibling); // Получение высоты navbar
    nextElement.style.setProperty('--body-padding', `${height}px`);
  };
  
  const getNavbarHeight = (navbar) => {
    return navbar.offsetHeight;
  };
  
  const modifyNavbar = (navbar, nextElement) => {
    setPadding(navbar);
    navbarHandler(navbar);
    setNavbarHeightAsPadding(nextElement);
  };
  
  const navbarHandler = (navbar) => {
    if (isScrolled()) {
      if (!navbar.classList.contains('nav--scrolled')) {
        navbar.classList.add('nav--scrolled');
      }
    } else {
      if (navbar.classList.contains('nav--scrolled')) {
        navbar.classList.remove('nav--scrolled');
      }
    }
  };

  export default navbarActions;
  