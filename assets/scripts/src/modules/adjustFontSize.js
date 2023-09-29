export const adjustFontSize = () => {
    const priceDiv = document.querySelector('.add-to-cart__summary');
    priceDiv.style.display = 'none';
    const windowWidth = window.innerWidth;
    const contentLength = priceDiv.textContent.length;
    const root = document.documentElement;
    const fontSettings = [
        { maxWidth: 768, sizes: {8: '3.5rem', 10: '3rem', 11: '2.25rem', 13: '2rem', 'default': '1.75rem'} },
        { maxWidth: 992, sizes: {8: '2.5rem', 10: '2.25rem', 11: '2rem', 13: '1.65rem', 'default': '1.35rem'} },
        { maxWidth: 1200, sizes: {8: '3rem', 10: '2.75rem', 11: '2.5rem', 13: '2.25rem', 'default': '2rem'} },
        { maxWidth: 1400, sizes: {8: '3rem', 10: '2.75rem', 11: '2.5rem', 13: '2.25rem', 'default': '2rem'} },
    ];

    let fontSize = '2.5rem';

    for (let setting of fontSettings) {
        if (!setting.maxWidth || windowWidth < setting.maxWidth) {
            fontSize = setting.sizes['default'];
            for (let length in setting.sizes) {
                if (contentLength <= parseInt(length)) {
                    fontSize = setting.sizes[length];
                    break;
                }
            }
            break;
        }
    }
    root.style.setProperty('--summary-size', fontSize);
    priceDiv.style.fontSize = fontSize;
    priceDiv.style.display = '';
}