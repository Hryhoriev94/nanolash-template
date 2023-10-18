export class VariantForm {
    constructor(variantForm) {
        this.form = variantForm;
        this.rows = this.form.querySelectorAll('.product__variant');
        this.variants = this.form.querySelectorAll('.product__variant__block');
        this._variantId = null;
        this._activeVariants = [];
        this.variantName = '';
        this.init();

    }

    init() {
        this.searchActiveVariants();
        this.variantId = this.activeVariants;
        this.addClickHandlers();
    }

    addClickHandlers() {
        this.variants.forEach(variant => {
            variant.addEventListener('click', this.changeActiveVariant.bind(this));
        });
    }

    changeActiveVariant(event) {
        const clickedVariant = event.target;
        const row = clickedVariant.closest('.product__variant');

        if (!clickedVariant.classList.contains('active')) {
            const currentActive = row.querySelector('.product__variant__block.active');
            if (currentActive) {
                currentActive.classList.remove('active');
            }
            clickedVariant.classList.add('active');
            this.searchActiveVariants();
            this.variantId = this.activeVariants;
        }
    }

    get activeVariants() {
        return this._activeVariants;
    }

    set activeVariants(variants) {
        if(Array.isArray(variants)) {
            this._activeVariants = variants;
        } else {
            console.error('Variants must be an array');
        }
    }

    updateProductName(name) {
        let newName = ''
        name.forEach(option => {
            let title = option.type;
            newName+= `${title.charAt(0).toUpperCase() + title.slice(1).toLowerCase()}:&nbsp;${option.value} `;
        });

        this.variantName = newName;
    }

    searchActiveVariants() {
        const arr = [];
        const name = [];
        this.rows.forEach(row => {
            const active = row.querySelector('.product__variant__block.active');
            if (active) {
                name.push({
                    type: row.previousElementSibling.textContent,
                    value: active.textContent
                });
                arr.push(active);
            }
        });
        this.updateProductName(name);
        this.activeVariants = arr;
    }



    get variantId() {
        return this._variantId;
    }

    set variantId(activeVariants) {
        const id = [];
        activeVariants.forEach(activeVariant => {
            id.push(activeVariant.getAttribute('data-id'));
        });
        this._variantId = id.join('');
    }
}