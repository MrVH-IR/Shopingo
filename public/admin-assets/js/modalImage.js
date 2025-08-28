document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const closeBtn = document.querySelector('.close-btn');

    document.querySelectorAll('.preview-img').forEach(img => {
    img.addEventListener('click', function() {
    modal.style.display = "flex";
    modal.classList.remove('fade-out');
    modalImg.classList.remove('zoom-out');
    modal.classList.add('fade-in');
    modalImg.classList.add('zoom-in');
    modalImg.src = this.src;
    });
});

    function closeModal() {
    modal.classList.remove('fade-in');
    modalImg.classList.remove('zoom-in');
    modal.classList.add('fade-out');
    modalImg.classList.add('zoom-out');
    setTimeout(() => {
    modal.style.display = "none";
    }, 300);
}

    closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
});
