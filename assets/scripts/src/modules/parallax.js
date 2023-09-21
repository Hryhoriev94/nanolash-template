'use-strict'

const parallax = () => {
  const absoluteOffset = (element) => {
    let top = 0;
    do {
      top += element.offsetTop || 0;
      element = element.offsetParent;
    } while(element);
    return { top };
  };

  const parallaxes = document.querySelectorAll('.product-order__image');

  parallaxes.forEach((element) => {
    const { top: elementOffset } = absoluteOffset(element);
    const elementHeight = element.offsetHeight;
    const middleOffset = elementOffset + elementHeight / 2;
    const middleViewport = window.scrollY + window.visualViewport.height / 2;

    if (middleOffset > window.scrollY - 500 && middleOffset < window.scrollY + window.visualViewport.height + 500) {
      const layers = element.querySelectorAll('.parallax__layer');
      layers.forEach((layer) => {
        let position = (elementHeight - layer.offsetHeight) / 2;
        const speed = +layer.getAttribute('data-parallax-speed') / 100;
        position += (middleOffset - middleViewport) * speed;
        layer.style.top = `${position}px`;
      });
    }
  });
};

export { parallax };