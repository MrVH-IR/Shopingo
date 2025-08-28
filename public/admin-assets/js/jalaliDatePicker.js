(function () {
    function bindInput(input) {
        if (input.dataset.jdpBound === '1') return;
        input.dataset.jdpBound = '1';

        if (!input.hasAttribute('data-jdp')) {
            input.setAttribute('data-jdp', '');
        }
        // فرمت خروجی (دلخواه)
        if (!input.getAttribute('data-jdp-format')) {
            input.setAttribute('data-jdp-format', 'YYYY-MM-DD');
        }

        // باز شدن روی فوکوس
        input.addEventListener('focus', function () {
            try { jalaliDatepicker.show(input); } catch (e) {}
        });
    }

    function resolveTarget(icon) {
        const sel = icon.dataset.target;
        if (sel) return document.querySelector(sel);
        // fallback: input کنار آیکون در همان form-group
        const parent = icon.closest('.form-group') || icon.parentElement;
        if (!parent) return null;
        return parent.querySelector('input.jalali-input');
    }

    function bindIcon(icon) {
        if (icon.dataset.jdpIconBound === '1') return;
        icon.dataset.jdpIconBound = '1';

        icon.addEventListener('click', function (e) {
            e.preventDefault();
            const input = resolveTarget(icon);
            if (!input) return;

            // مطمئن شو data-jdp دارد
            if (!input.hasAttribute('data-jdp')) input.setAttribute('data-jdp', '');

            try { jalaliDatepicker.startWatch(); } catch (e2) {}

            // بعضی‌وقت‌ها فقط focus کافی است، ولی برای اطمینان show هم می‌زنیم
            input.focus();
            setTimeout(function () {
                try { jalaliDatepicker.show(input); } catch (e3) {}
            }, 0);
        });
    }

    function init(root = document) {
        const inputs = root.querySelectorAll('input.jalali-input');
        inputs.forEach(bindInput);

        const icons = root.querySelectorAll('.calendar-icon');
        icons.forEach(bindIcon);

        // safe to call multiple times
        try { jalaliDatepicker.startWatch(); } catch (e) {}
    }

    // اکسپورت برای استفاده بعد از ajax/livewire
    window.initJalaliPickers = init;

    document.addEventListener('DOMContentLoaded', function () {
        init();
    });
})();
