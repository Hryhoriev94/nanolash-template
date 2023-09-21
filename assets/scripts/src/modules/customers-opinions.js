export class Slider {
    constructor(rootElement) {
        this.rootElement = rootElement;
        this.currentSlide = 0;
        this.slidesContainer = this.rootElement.querySelector('.customers-opinions__slides');
        this.slides = this.rootElement.querySelectorAll('.customers-opinions__slide');
        this.isDragging = false;
        this.startX = 0;
        this.currentTranslate = 0;
        this.lastTranslate = 0;
        this.startTime = 0;
        this.isMoved = false;

        if (!this.slidesContainer || this.slides.length === 0) {
            console.error("Brak wymaganych elementów slidera!");
            return;
        }

        this.autoplay = this.rootElement.getAttribute('data-autoplay') !== 'false';
        this.iteration = parseInt(this.rootElement.getAttribute('data-iteration'), 10) || 5;
        this.draggable = this.rootElement.getAttribute('data-draggable') !== 'false';

        this.generateDots();
        this.init();
    }

    init() {
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                this.goToSlide(index);
            });
        });

        this.rootElement.querySelector('.customers-opinions__arrow--prev').addEventListener('click', () => {
            this.prevSlide();
        });

        this.rootElement.querySelector('.customers-opinions__arrow--next').addEventListener('click', () => {
            this.nextSlide();
        });

        this.autoSlideInterval = null;
        this.startAutoSlide();

        this.rootElement.addEventListener('mouseenter', () => this.stopAutoSlide(), {passive: true});
        this.rootElement.addEventListener('touchstart', () => this.stopAutoSlide(), {passive: true});

        this.rootElement.addEventListener('mouseleave', () => this.startAutoSlide(), {passive: true});
        this.rootElement.addEventListener('touchend', () => this.startAutoSlide(), {passive: true});

        if (this.draggable) {
            this.slidesContainer.addEventListener('mousedown', this.startDragging.bind(this), {passive: true});
            this.slidesContainer.addEventListener('mousemove', this.drag.bind(this), {passive: true});
            this.slidesContainer.addEventListener('mouseup', this.endDragging.bind(this), {passive: true});
            this.slidesContainer.addEventListener('mouseleave', this.endDragging.bind(this), {passive: true});
        }
    }

    startDragging(event) {
        this.isDragging = true;
        this.startX = event.clientX - this.currentTranslate;
        this.startTime = Date.now();
        this.slidesContainer.style.transition = 'none';
    }

    drag(event) {
        if (!this.isDragging) return;
        const x = event.clientX;
        this.currentTranslate = x - this.startX;
        if (Math.abs(this.currentTranslate - this.lastTranslate) > 10) {
            this.isMoved = true;
        }
        this.slidesContainer.style.transform = `translateX(${this.currentTranslate}px)`;
    }


    endDragging(event) {
        const movedBy = this.currentTranslate - this.lastTranslate;
        const slideWidth = this.slides[0].getBoundingClientRect().width;
    
        if (this.isMoved) {
            if (movedBy < -slideWidth / 8) {
                this.nextSlide();
            } else if (movedBy > slideWidth / 8) {
                this.prevSlide();
            } else {
                this.slidesContainer.style.transform = `translateX(-${slideWidth * this.currentSlide}px)`;
            }
        }
    
        this.slidesContainer.style.transition = 'transform 0.3s';
        this.isDragging = false;
        this.isMoved = false;
    }
    

    goToSlide(index) {
        const slideWidth = this.slides[0].getBoundingClientRect().width;
        this.slidesContainer.style.transform = `translateX(-${slideWidth * index}px)`;
        this.dots[this.currentSlide].classList.remove('active');
        this.dots[index].classList.add('active');
        this.currentSlide = index;
        this.lastTranslate = -slideWidth * index;
    }

    prevSlide() {
        const newIndex = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        this.goToSlide(newIndex);
    }

    nextSlide() {
        const newIndex = (this.currentSlide + 1) % this.slides.length;
        this.goToSlide(newIndex);
    }

    startAutoSlide() {
        if (this.autoplay && !this.autoSlideInterval) {
            this.autoSlideInterval = setInterval(() => {
                this.nextSlide();
            }, this.iteration * 1000);
        }
    }

    stopAutoSlide() {
        if (this.autoSlideInterval) {
            clearInterval(this.autoSlideInterval);
            this.autoSlideInterval = null;
        }
    }

    generateDots() {
        const dotsContainer = this.rootElement.querySelector('.customers-opinions__dots');
        const navText = this.rootElement.getAttribute('data-nav-text') || "";

        this.slides.forEach((_, index) => {
            const dot = document.createElement('li');
            dot.classList.add('customers-opinions__dot');
            dot.setAttribute('data-slide', index);
            dot.setAttribute('aria-label', `${navText} ${index + 1}`);
            if (index === 0) {
                dot.classList.add('active');
            }
            dotsContainer.appendChild(dot);
        });

        this.dots = this.rootElement.querySelectorAll('.customers-opinions__dot');
    }
}
