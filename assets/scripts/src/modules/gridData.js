export class Grid {
    constructor() {
        this.gridElement = document.querySelector('.products__grid');
        this.initEventListeners();
        this.init();
    }

    initEventListeners() {
        // Событие клика на кнопку добавления в корзину
        this.gridElement.addEventListener('click', (event) => {
            if (event.target.closest('.add-to-cart__button')) {
                const productItem = event.target.closest('.products__item');
                const alias = productItem.dataset.type;
                const domain = window.location.hostname;
                this.fetchProductData(alias, domain, productItem);
            }
        });
    }

    fetchProductData(alias, domain, productItem) {
        console.log(alias)
        fetch('/getData.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                alias: alias,
                domain: domain
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.product) {
                const priceElement = productItem.querySelector('.price');
                const currency = data.currency.toUpperCase();
                const price = data.product.price[currency.toLowerCase()];
                priceElement.textContent = `${price} ${currency}`;

                const typeElement = document.createElement('div');
                typeElement.className = 'product-type';
                typeElement.textContent = data.product.type;
                productItem.appendChild(typeElement);
            } else {
                console.error(data.error || 'Error fetching product data');
            }
        })
        .catch(error => console.error('Error:', error));
    }
    init() {
        const productItems = Array.from(this.gridElement.querySelectorAll('.products__item'));
        const domain = window.location.hostname;

        // Запрос данных для каждого продукта
        productItems.forEach(productItem => {
            const alias = productItem.dataset.type;
            this.fetchProductData(alias, domain, productItem);
        });
    }
}