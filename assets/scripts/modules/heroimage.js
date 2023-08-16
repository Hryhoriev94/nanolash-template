export const heroimage = () => {
    const dotsContainer = document.querySelector('.hero__dots'); 
    const slides = document.querySelector('.hero__image__container .slides');

    function replaceSrc(element, newSrcBase) {
        const isSrcset = element.hasAttribute('srcset');
        const isSrc = element.hasAttribute('src');

        if (!isSrcset && !isSrc) return;

        const attributeType = isSrcset ? 'srcset' : 'src';
        const currentValue = element.getAttribute(attributeType);
        const updatedValue = currentValue.replace(/^(.*?)(@.*)$/, `${newSrcBase}$2`);

        const imgLoader = new Image();
        imgLoader.onload = () => element.setAttribute(attributeType, updatedValue);
        imgLoader.src = updatedValue.split(' ')[0];
    }

    function changeImageByIndex(dot) {
        const currentIndex = dot.getAttribute('data-slide');
        const image = document.querySelector('.hero__image__block picture');
        const sources = image.querySelectorAll('source');
        const newSrcBase = slides.querySelector(`[data-slides="${currentIndex}"]`).getAttribute('data-src');

        sources.forEach(source => replaceSrc(source, newSrcBase));

        const imgElement = image.querySelector('img');
        if (imgElement) {
            replaceSrc(imgElement, newSrcBase);
        }
    }

    dotsContainer.addEventListener('click', (event) => {
        let currentDot = event.target;

        while (currentDot && !currentDot.classList.contains('hero__dot')) {
            currentDot = currentDot.parentElement;
        }

        if (!currentDot || !currentDot.classList.contains('hero__dot') || currentDot.classList.contains('active')) {
            return;
        }
        
        const activeSlide = document.querySelector('.hero__dot.active');
        activeSlide.classList.remove('active');
        currentDot.classList.add('active');

        changeImageByIndex(currentDot);
    });
}
