document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.compare-btn').forEach(button => {
        button.addEventListener('click', async () => {
            if (button.disabled) return;

            const url = button.dataset.url;

            button.disabled = true;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }

                const data = await response.json();

                if (!data.success) return;

                const icon = button.querySelector('i');
                const text = button.querySelector('span');

                if (data.action === 'added') {
                    icon.classList.add('text-primary');
                    text.textContent = 'در لیست مقایسه';
                    button.setAttribute('title', 'حذف از مقایسه');
                } else if (data.action === 'removed') {
                    icon.classList.remove('text-primary');
                    text.textContent = 'افزودن به مقایسه';
                    button.setAttribute('title', 'افزودن به مقایسه');
                }
            } catch (error) {
                console.error('Compare error:', error);
            } finally {
                button.disabled = false;
            }
        });
    });
});
