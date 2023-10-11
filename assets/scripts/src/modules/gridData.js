// файл grid.js
import { AjaxHelper } from './ajaxHelper.js';
// import { Modal } from './modal.js';
import cartInstance from './cart.js';

export class Grid {
    #productData = new Map();  // Приватное свойство для хранения данных продукта

    constructor() {
        this.gridElement = document.querySelector('.products__grid');
        this.initEventListeners();
        // this.modal = new Modal();
        this.init();
    }

    initEventListeners() {
        // Слушатель для кнопок плюс и минус
        this.gridElement.addEventListener('click', (event) => {
            const target = event.target;
            const productItem = target.closest('.products__item');
            if (!productItem) return;
    
            const alias = productItem.dataset.type;
            if (target.matches('.plus')) {
                this.changeQuantity(alias, 1);
            } else if (target.matches('.minus')) {
                this.changeQuantity(alias, -1);
            }
        });
    
        // Отдельный слушатель для добавления в корзину
        this.gridElement.addEventListener('click', (event) => {
            if (event.target.closest('.add-to-cart')) {
                const productItem = event.target.closest('.products__item');
                if (!productItem) return;  // Добавлена проверка
    
                const alias = productItem.dataset.type;
                // this.showProductModal(alias);
            }
        });
    }
    

    // showProductModal(alias) {
    //     const productInfo = this.getProductInfo(alias);
    //     if (!productInfo) {
    //         console.error('Product info not found:', alias);
    //         return;
    //     }

    //     const contentStructure = [
    //         { tag: 'h1', text: productInfo.name },
    //         { tag: 'p', text: `Price: ${productInfo.price} ${productInfo.currency}` },
    //         { tag: 'p', text: `Quantity: ${productInfo.quantity}` },
    //     ];

    //     this.modal.open(contentStructure);
    // }

    fetchProductData(alias, domain, productItem) {
        AjaxHelper.fetchData('/getData.php', { alias, domain })
            .then(data => {
                if (data.product) {
                    const currency = data.currency.toUpperCase();
                    const price = data.product.price[currency.toLowerCase()];

                    // Сохраняем данные продукта в приватном свойстве
                    this.#productData.set(alias, { price, currency });

                    const priceElementNew = productItem.querySelector('.price .new-price .sum');
                    const currencyElementNew = productItem.querySelector('.price .new-price .currency');
                    priceElementNew.textContent = price;
                    currencyElementNew.textContent = currency;

                    // ... остальной код
                } else {
                    console.error(data.error || 'Error fetching product data');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    changeQuantity(alias, delta) {
        const productItem = this.gridElement.querySelector(`.products__item[data-type="${alias}"]`);
        if (!productItem) {
            console.error('Product item not found:', alias);
            return;
        }

        const quantityInput = productItem.querySelector('input[type="text"]');
        if (!quantityInput) {
            console.error('Quantity input not found in product item:', alias);
            return;
        }

        let quantity = parseInt(quantityInput.value, 10) + delta;
        quantity = Math.max(1, quantity);  // предполагая, что минимальное количество равно 1

        quantityInput.value = quantity;

        this.updatePrice(productItem, quantity);
    }

    addToCart(alias) {
        const product = this.getProductInfo(alias);
        if (!product) return;

        cartInstance.addProduct({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: product.quantity,
        });
    }

    getProductInfo(alias) {
        const productData = this.#productData.get(alias);
        if (!productData) return null;

        const productItem = this.gridElement.querySelector(`.products__item[data-type="${alias}"]`);
        if (!productItem) return null;

        const quantityInput = productItem.querySelector('input[type="text"]');
        const quantity = parseInt(quantityInput.value, 10);

        return {
            id: alias,
            name: productItem.querySelector('.title').textContent,
            price: productData.price,
            quantity: quantity
        };
    }

    updatePrice(productItem, quantity) {
        const alias = productItem.dataset.type;
        const productData = this.#productData.get(alias);
        if (!productData) return;

        const priceElementNew = productItem.querySelector('.price .new-price .sum');
        const priceElementOld = productItem.querySelector('.price .old-price .sum');
        const currencyElementOld = productItem.querySelector('.price .old-price .currency');
        const currencyElementNew = productItem.querySelector('.price .new-price .currency');

        const unitPrice = productData.price;
        const totalPrice = unitPrice * quantity;

        priceElementNew.textContent = totalPrice;
        // Считаем, что старая цена равна цене за единицу
        priceElementOld.textContent = unitPrice;

        const currency = localStorage.getItem('currency');
        if (currency) {
            currencyElementOld.textContent = currency;
            currencyElementNew.textContent = currency;
        } else {
            console.error('Currency not found in localStorage');
        }
    }

    init() {
        const productItems = Array.from(this.gridElement.querySelectorAll('.products__item'));
        const domain = window.location.hostname;

        // Запрос данных для каждого продукта
        productItems.forEach(productItem => {
            const alias = productItem.dataset.type;
            if(productItem.querySelector('.price')) {
                this.fetchProductData(alias, domain, productItem);
            }
        });
    }
}
