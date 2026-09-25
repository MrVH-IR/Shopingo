document.addEventListener('DOMContentLoaded', () => {
    const menu = document.querySelector('.categories-menu');

    if (!menu) return;

    const items = menu.querySelectorAll('.category-sidebar-item');
    const panels = menu.querySelectorAll('.category-panel');

    items.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const categoryId = item.dataset.categoryId;

            items.forEach(element => element.classList.remove('active'));
            panels.forEach(element => element.classList.remove('active'));

            item.classList.add('active');

            const panel = menu.querySelector(`[data-category-panel="${categoryId}"]`);

            if (panel) {
                panel.classList.add('active');
            }
        });
    });
});
