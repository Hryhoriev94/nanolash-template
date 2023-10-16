export class SocialSlider {
    constructor() {
        this.actionQueue = [];
        this.processingQueue = false
        this.slidesContainer = document.querySelector('.socials__slides');
        this.prevButton = document.querySelector('.socials__prev');
        this.nextButton = document.querySelector('.socials__next');
        this.slides = Array.from(this.slidesContainer.children);
        this.slideWidth = this.slides[0].offsetWidth;
        this.init();
    }

    processQueue = () => {
        if (this.processingQueue) return;  // Если очередь уже обрабатывается, выйти
        if (this.actionQueue.length === 0) return;  // Если очередь пуста, выйти

        this.processingQueue = true;  // Установить флаг обработки очереди в true
        const action = this.actionQueue.shift();  // Получить первое действие из очереди
        action();  // Вызвать действие
    }

    onTransitionEnd = () => {
        this.processingQueue = false;  // Сбросить флаг обработки очереди
        this.processQueue();  // Попытаться обработать следующее действие в очереди
    }

    updateSlides() {
        this.slides = Array.from(this.slidesContainer.children);
        this.slideWidth = this.slides[0].offsetWidth;
    }

    handlePrevClick = () => {
        this.actionQueue.push(this.prevAction);  // Добавить действие в очередь
        this.processQueue();  // Попытаться обработать очередь
    }

    prevAction  = () => {
        const lastSlide = this.slidesContainer.lastElementChild;
        const clonedSlide = lastSlide.cloneNode(true);
        this.slidesContainer.prepend(clonedSlide);
        this.slidesContainer.style.transition = 'none';
        this.slidesContainer.style.transform = `translateX(-${this.slideWidth}px)`;
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                this.slidesContainer.style.transition = 'transform 0.3s ease-in-out';
                this.slidesContainer.style.transform = 'translateX(0)';
            });
        });
        lastSlide.remove();
        this.updateSlides();
        this.slidesContainer.addEventListener('transitionend', this.onTransitionEnd, { once: true });
    }

    handleNextClick = () => {
        this.actionQueue.push(this.nextAction);  // Добавить действие в очередь
        this.processQueue();  // Попытаться обработать очередь
    }

    nextAction  = () => {
        const firstSlide = this.slidesContainer.firstElementChild;
        const clonedSlide = firstSlide.cloneNode(true);
        this.slidesContainer.append(clonedSlide);
        this.slidesContainer.style.transition = 'transform 0.3s ease-in-out';
        this.slidesContainer.style.transform = `translateX(-${this.slideWidth}px)`;
        this.slidesContainer.addEventListener('transitionend', () => {
            this.slidesContainer.style.transition = 'none';
            this.slidesContainer.style.transform = 'translateX(0)';
            firstSlide.remove();
            this.updateSlides();
            this.onTransitionEnd();
        }, { once: true });
    }

    init() {
        this.slidesContainer.style.transition = 'transform 0.3s ease-in-out';
        this.prevButton.addEventListener('click', this.handlePrevClick);
        this.nextButton.addEventListener('click', this.handleNextClick);
        window.addEventListener('resize', () => {
            this.slideWidth = this.slides[0].offsetWidth;
        })
    }
}
