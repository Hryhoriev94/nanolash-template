import { slideDown, slideUp } from "./helpers";

export const faq = () => {
    const faq = document.querySelector('.faq');
    const faqElements = faq.querySelectorAll('.faq__element');

    const faqHandler = (element) => {
        const openElement = faq.querySelector('.open');
        if(element == openElement) {
            hideElement(element);
            return
        }
        if(openElement) {
            hideElement(openElement);
        }
        showElement(element)
        return;
    }
    

    const hideElement = (elem) => {
        elem.classList.remove('open');
        const answer = elem.querySelector('.faq__answer');
        slideUp(answer, 300);
    }
    const showElement = (elem) => {
        elem.classList.add('open');
        const answer = elem.querySelector('.faq__answer');
        slideDown(answer, 300);
    }

    faqElements.forEach((faqElement, index) => {
        const question = faqElement.querySelector('.faq__question')
        question.addEventListener('click', () => {
            faqHandler(faqElement)
        })
    })
}