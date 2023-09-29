const loadCSS = (href, mediaQuery) => {
    if (mediaQuery && !window.matchMedia(mediaQuery).matches) {
      return;
    }
  
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = href;
    document.head.appendChild(link);

  }
  
  export const asyncCss = () => {
    window.addEventListener('load', function() {
      loadCSS(`/assets/styles/pages/${template}.css`);
      loadCSS(`/assets/styles/pages/${template}-desktop.css`, '(min-width: 768px)');
    }); 
  }
