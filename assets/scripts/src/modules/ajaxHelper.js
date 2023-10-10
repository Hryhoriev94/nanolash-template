export class AjaxHelper {
    static fetchData(url, params) {
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(params),
        })
        .then(response => response.json())
        .catch(error => console.error('Error:', error));
    }
}
