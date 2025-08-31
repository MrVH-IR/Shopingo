(() => {
    const bindInput = (input) => {
        if (input.dataset.jdpBound === '1') return;
        input.dataset.jdpBound = '1';

        // اضافه کردن attribute های ضروری
        input.setAttribute('data-jdp', '');
        if (!input.getAttribute('data-jdp-format')) {
            input.setAttribute('data-jdp-format', 'YYYY-MM-DD HH:mm:ss'); // تاریخ + ساعت
        }

        input.addEventListener('focus', () => {
            try { jalaliDatepicker.show(input); } catch (e) { console.error(e); }
        });
    };

    const resolveTarget = (icon) => {
        const selector = icon.dataset.target;
        if (selector) return document.querySelector(selector);

        const parent = icon.closest('.form-group') || icon.parentElement;
        return parent?.querySelector('input.jalali-input') || null;
    };

    const bindIcon = (icon) => {
        if (icon.dataset.jdpIconBound === '1') return;
        icon.dataset.jdpIconBound = '1';

        icon.addEventListener('click', (e) => {
            e.preventDefault();
            const input = resolveTarget(icon);
            if (!input) return;

            input.setAttribute('data-jdp', '');

            try { jalaliDatepicker.startWatch(); } catch (e) { console.error(e); }

            input.focus();
            setTimeout(() => {
                try { jalaliDatepicker.show(input); } catch (e) { console.error(e); }
            }, 0);
        });
    };

    const initJalaliPickers = (root = document) => {
        root.querySelectorAll('input.jalali-input').forEach(bindInput);
        root.querySelectorAll('.calendar-icon').forEach(bindIcon);

        try { jalaliDatepicker.startWatch({
            time: true,
            hasSecond: true,
            autoShow: true,
            autoHide: true
        }); } catch (e) { console.error(e); }
    };

    // expose globally
    window.initJalaliPickers = initJalaliPickers;

    document.addEventListener('DOMContentLoaded', () => initJalaliPickers());
})();
