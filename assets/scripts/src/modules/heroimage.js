import { debounce } from "./helpers.js";

export const heroimage = () => {
    const dotsContainer = document.querySelector('.hero__dots');
    const mainImageContainer = document.querySelector('.hero__image__container');
    let isLoading = false;

    if (!dotsContainer || !mainImageContainer) {
        return;
    }

    const slides = mainImageContainer.querySelector('.slides');
    if (!slides) return;

    const handleResize = debounce(dotsContainerHeightHandler, 150);

    function replaceSrc(element, newSrcBase, extension) {
        if (!element || !extension) return;
    
        const isSrcset = element.hasAttribute('srcset');
        const isSrc = element.hasAttribute('src');
    
        if (!isSrcset && !isSrc) return;
    
        const attributeType = isSrcset ? 'srcset' : 'src';
        const currentValue = element.getAttribute(attributeType);
        const updatedValue = currentValue.replace(/^(.*?)(@\w+\.\w+)$/, `${newSrcBase}$2`).replace(/\.\w+$/, `.${extension}`);
        const imgLoader = new Image();
    
        imgLoader.onload = () => {
            element.setAttribute(attributeType, updatedValue);
            removeLoadingWhenComplete(element);
        }
    
        imgLoader.src = `${newSrcBase}@xs.${extension}`;
        isLoading = true;
        mainImageContainer.classList.add('loading');
    }

    function removeLoadingWhenComplete(element) {
        if (element.complete) {
            mainImageContainer.classList.remove('loading');
            isLoading = false;
        } else {
            setTimeout(() => removeLoadingWhenComplete(element), 0);
        }
    }

    function changeImageByIndex(dot) {
        const currentIndex = dot.getAttribute('data-slide');
        if (!currentIndex) return;
    
        const image = mainImageContainer.querySelector('.hero__image__block picture');
        if (!image) return;
    
        const sources = image.querySelectorAll('source');
        const newSrcBaseElem = slides.querySelector(`[data-slides="${currentIndex}"]`);
        if (!newSrcBaseElem) return;
    
        const newSrcBase = newSrcBaseElem.getAttribute('data-src');
        const newExtension = newSrcBaseElem.getAttribute('data-extension');
        if (!newSrcBase || !newExtension) return;
    
        sources.forEach(source => replaceSrc(source, newSrcBase, newExtension));
    
        const imgElement = image.querySelector('img');
        if (imgElement) {
            replaceSrc(imgElement, newSrcBase, newExtension);
        }
    }

    function dotsContainerHeightHandler() {
        const visibleElements = parseInt(dotsContainer.getAttribute('data-visible'), 10);
        if (isNaN(visibleElements)) return;

        const dotsQuantity = dotsContainer.querySelectorAll('.hero__dot').length;
        if (dotsQuantity > visibleElements) {
            const dotHeightElem = dotsContainer.querySelector('.hero__dot');
            if (!dotHeightElem) return;

            const dotHeight = dotHeightElem.offsetHeight;
            dotsContainer.style.maxHeight = (window.innerWidth < 576) ? `${visibleElements * dotHeight + 30}px` : 'initial';
        } else {
            dotsContainer.style.maxHeight = 'initial';
            window.removeEventListener('resize', handleResize);
        }
    }

    dotsContainerHeightHandler();

    dotsContainer.addEventListener('click', (event) => {
        const currentDot = event.target.closest('.hero__dot');
        if (!currentDot || currentDot.classList.contains('active')) return;

        document.querySelector('.hero__dot.active')?.classList.remove('active');
        currentDot.classList.add('active');
        changeImageByIndex(currentDot);
    });

    window.addEventListener('resize', handleResize);
}


