$(document).ready(function () {
    $('.image-sizes-btn-group').each(function () {
        let group = $(this);
        let imageId = group.data('id');

        $.ajax({
            url: `/admin/market/Product/gallery/change-size/${imageId}`,
            type: 'GET',
            success: function (response) {
                group.find(`[data-size="${response.currentImage}"]`).addClass('active');
            }
        });
    });

    $('.image-sizes-btn-group .btn').on('click', function () {
        let btn = $(this);
        let size = btn.data('size');
        let group = btn.closest('.image-sizes-btn-group');
        let imageId = group.data('id');
        let wrapper = group.closest('tr').find('.status-wrapper'); // محل نمایش پیام

        $.ajax({
            url: `/admin/market/Product/gallery/change-size/${imageId}`,
            type: 'GET',
            data: { size: size },
            success: function (response) {
                group.find('.btn').removeClass('active');
                btn.addClass('active');
                showStatusMessage(wrapper, 'سایز تصویر با موفقیت تغییر کرد ✅', true);
            },
            error: function () {
                showStatusMessage(wrapper, 'خطا در تغییر سایز ❌', false);
            }
        });
    });
});

function showStatusMessage(wrapper, message, success = true) {
    wrapper.find('.status-message').remove();

    var msg = $('<div>')
        .addClass('status-message')
        .addClass(success ? 'status-success' : 'status-error')
        .text(message);

    wrapper.append(msg);

    setTimeout(() => {
        msg.fadeOut(300, function() { $(this).remove(); });
    }, 3000);
}
