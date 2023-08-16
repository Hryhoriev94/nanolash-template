import { debounce } from "./helpers.js";

export const heroimage = () => {
    const dotsContainer = document.querySelector('.hero__dots');
    const mainImageContainer = document.querySelector('.hero__image__container');
    let isLoading = false;

    if (!dotsContainer || !dotsContainer.hasChildNodes()) {
        return;
    }

    const slides = document.querySelector('.hero__image__container .slides');
    if (!slides) return;

    const handleResize = debounce(dotsContainerHeightHandler, 150);

    function replaceSrc(element, newSrcBase) {
        if (!element) return;

        const isSrcset = element.hasAttribute('srcset');
        const isSrc = element.hasAttribute('src');

        if (!isSrcset && !isSrc) return;

        const attributeType = isSrcset ? 'srcset' : 'src';
        const currentValue = element.getAttribute(attributeType);
        const updatedValue = currentValue.replace(/^(.*?)(@.*)$/, `${newSrcBase}$2`);
        const imgLoader = new Image();
        imgLoader.onload = () => {
            element.setAttribute(attributeType, updatedValue);
            removeLoadingWhenComplete(element);
        }
        imgLoader.src = updatedValue.split(' ')[0];
        isLoading = true;
        mainImageContainer.classList.add('loading');
    }

    function removeLoadingWhenComplete(element) {
        if (element.complete) {
            mainImageContainer.classList.remove('loading');
            isLoading = false;
        } else {
            setTimeout(() => removeLoadingWhenComplete(element), 50);
        }
    }

    function changeImageByIndex(dot) {
        if (!dot) return;

        const currentIndex = dot.getAttribute('data-slide');
        if (!currentIndex) return;

        const image = document.querySelector('.hero__image__block picture');
        if (!image) return;

        const sources = image.querySelectorAll('source');
        const newSrcBaseElem = slides.querySelector(`[data-slides="${currentIndex}"]`);
        if (!newSrcBaseElem) return;

        const newSrcBase = newSrcBaseElem.getAttribute('data-src');
        if (!newSrcBase) return;

        sources.forEach(source => replaceSrc(source, newSrcBase));

        const imgElement = image.querySelector('img');
        if (imgElement) {
            replaceSrc(imgElement, newSrcBase);
        }
    }

    function dotsContainerHeightHandler() {
        const visibleElements = parseInt(dotsContainer.getAttribute('data-visible'), 10);
        if (isNaN(visibleElements)) return;

        const dotsQuantity = dotsContainer.querySelectorAll('.hero__dot').length;
        if(dotsQuantity > visibleElements) {
            const dotHeightElem = dotsContainer.querySelector('.hero__dot');
            if (!dotHeightElem) return;

            const dotHeight = dotHeightElem.offsetHeight;
            dotsContainer.style.maxHeight = visibleElements * dotHeight + 30 + 'px';
        } else {
            dotsContainer.style.maxHeight = 'initial';
            window.removeEventListener('resize', handleResize);
        }
    }

    dotsContainerHeightHandler();

    dotsContainer.addEventListener('click', (event) => {
        if (isLoading) return;
        let currentDot = event.target;

        while (currentDot && !currentDot.classList.contains('hero__dot')) {
            currentDot = currentDot.parentElement;
        }

        if (!currentDot || currentDot.classList.contains('active')) {
            return;
        }
        
        const activeSlide = document.querySelector('.hero__dot.active');
        if (activeSlide) {
            activeSlide.classList.remove('active');
        }

        currentDot.classList.add('active');
        changeImageByIndex(currentDot);
    });

    window.addEventListener('resize', handleResize);
}
