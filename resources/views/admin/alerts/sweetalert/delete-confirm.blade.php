<script>
    $(document).ready(function () {
        const className = @json($className);

        $('.' + className).on('click', function (event) {
            event.preventDefault();

            const trigger = this;
            const formId = $(trigger).data('id')
                ? '#delete-form-' + $(trigger).data('id')
                : '#' + $(trigger).attr('form');

            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: 'این عملیات قابل بازگشت نیست.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله، حذف شود',
                cancelButtonText: 'انصراف',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'mx-2 rounded-2xl bg-rose-600 px-5 py-3 text-sm font-semibold text-white',
                    cancelButton: 'mx-2 rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700',
                    popup: 'rounded-3xl',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $(formId).trigger('submit');
                }
            });
        });
    });
</script>
