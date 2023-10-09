export class SocialSlider {
    constructor() {
        this.slidesContainer = document.querySelector('.socials__slides');
        this.prevButton = document.querySelector('.socials__prev');
        this.nextButton = document.querySelector('.socials__next');
        this.slides = Array.from(this.slidesContainer.children);
        this.slideWidth = this.slides[0].offsetWidth;
        this.init();
    }

    updateSlides() {
        this.slides = Array.from(this.slidesContainer.children);
        this.slideWidth = this.slides[0].offsetWidth;
    }

    handlePrevClick = () => {
        const lastSlide = this.slidesContainer.lastElementChild;
        this.slidesContainer.prepend(lastSlide);
        this.slidesContainer.style.transition = 'none';
        this.slidesContainer.style.transform = `translateX(-${this.slideWidth}px)`;
        setTimeout(() => {
            this.slidesContainer.style.transition = 'transform 0.3s ease-in-out';
            this.slidesContainer.style.transform = 'translateX(0)';
        }, 0);
        this.updateSlides();
    }

    handleNextClick = () => {
        const firstSlide = this.slidesContainer.firstElementChild;
        this.slidesContainer.style.transition = 'transform 0.3s ease-in-out';
        this.slidesContainer.style.transform = `translateX(-${this.slideWidth}px)`;
        this.slidesContainer.addEventListener('transitionend', () => {
            this.slidesContainer.style.transition = 'none';
            this.slidesContainer.style.transform = 'translateX(0)';
            this.slidesContainer.append(firstSlide);
            this.updateSlides();
        }, { once: true });
    }

    init() {
        this.prevButton.addEventListener('click', this.handlePrevClick);
        this.nextButton.addEventListener('click', this.handleNextClick);
    }
}
