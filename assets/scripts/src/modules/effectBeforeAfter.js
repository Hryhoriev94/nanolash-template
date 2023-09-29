export const effectBeforeAfterHandler = () => {
    const slider = document.querySelector('.product-effects--slider');
    if(!slider) return;
    const after = slider.querySelector('.product-effects__after');
    if(!after) return;
    const controls = slider.querySelector('.product-effects__controls');
    if(!controls) return;

    const moveHandler = (clientX) => {
        const rect = slider.getBoundingClientRect();
        let newLeft = clientX - rect.left;

        newLeft = Math.min(rect.width, Math.max(0, newLeft));

        const newWidth = (newLeft / rect.width) * 100;

        after.style.width = `${newWidth}%`;
        controls.style.left = `${newLeft - 1}px`;
    };

    slider.addEventListener('mousemove', (e) => {
        moveHandler(e.clientX);
    }, {passive: true});
    
    slider.addEventListener('touchmove', (e) => {
        moveHandler(e.touches[0].clientX);
    }, {passive: true});
};
