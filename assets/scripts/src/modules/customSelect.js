export class CustomSelect {
    constructor(element, onChangeCallback) {
        this.selectElement = element;
        this.displayElement = element.querySelector('.display');
        this.textActiveContainer = this.displayElement.querySelector('.current');
        this.optionsContainer = element.querySelector('.options-container');
        this.options = this.selectElement.querySelectorAll('.option');
        this.activeOption = this.options[0];
        this.height = 0;
        this.init()
    }
    init() {
        this.getOptionsHeight();
        this.showActiveOption(this.activeOption)
        this.options.forEach(option => {
            option.addEventListener('click', (e) => {
                this.changeActiveElement(e.target);
            });
        });
        document.addEventListener('click', (e) => {
            if(e.target == this.displayElement || this.displayElement.contains(e.target)) {
                if(this.selectElement.classList.contains('open')) {
                    this.close();
                } else {
                    this.open();
                }
            } 
            else {
                if(this.selectElement.classList.contains('open')) {
                    this.close();
                }
            }
        })
    }
    getOptionsHeight() {
        let summaryHeight = 0;
        this.options.forEach(option => {
            let rect = option.getBoundingClientRect();
            let totalHeight = rect.height;
            summaryHeight += totalHeight;
        });
        this.height = summaryHeight;
    }
    open() {
        this.selectElement.classList.add('open');
        this.optionsContainer.style.maxHeight = this.height + 'px';
    }
    close() {
        this.selectElement.classList.remove('open');
        this.optionsContainer.removeAttribute('style');
    }
    changeActiveElement(newActiveOption) {
        this.activeOption = newActiveOption;
        this.showActiveOption(this.activeOption);
        this.close();
        if (this.onChangeCallback && typeof this.onChangeCallback === 'function') {
            this.onChangeCallback(this.activeOption.getAttribute('data-alias'));  // вызвать обратный вызов с новым alias
        }
    }
    showActiveOption(option) {
        this.options.forEach(option => {
            option.classList.remove('selected');
        })
        this.activeOption.classList.add('selected');
        this.textActiveContainer.textContent = option.textContent
    }
} 
