$(document).on('click', '.favorite-btn', function (e) {

    e.preventDefault();

    const button = $(this);
    const icon = button.find('i');
    const url = button.data('url');

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.action === 'added') {
                icon
                    .removeClass('text-dark')
                    .addClass('text-danger');

                button.attr(
                    'data-bs-original-title',
                    'حذف از علاقه مندی'
                );
            } else {
                icon
                    .removeClass('text-danger')
                    .addClass('text-dark');
                button.attr(
                    'data-bs-original-title',
                    'افزودن به علاقه مندی'
                );
            }
        },
        error: function (xhr) {
            if (xhr.status === 401) {
                $('.toast').toast('show');
                return;
            }
        }
    });
});
