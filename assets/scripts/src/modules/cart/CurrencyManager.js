export class CurrencyManager {
    static setCurrency(currency) {
        localStorage.setItem('currency', currency);
    }
    static getCurrency() {
        return new Promise((resolve, reject) => {
            const sendData = window.location.hostname;
            fetch('/getData.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `domain=${sendData}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    reject('Product not found');
                } else {
                    resolve(data.currency);
                }
            })
            .catch(error => {
                reject(error);
            });
        });
    }
}