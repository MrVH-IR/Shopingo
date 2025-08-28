function changeStatus(elementId) {
    var element = $("#" + elementId);
    var url = element.attr('data-url');
    var elementValue = !element.prop('checked');
    var wrapper = element.closest('.status-wrapper');

    $.ajax({
        url: url,
        type: "GET",
        success: function(response) {
            if (response.status) {
                element.prop('checked', response.checked);
                showStatusMessage(wrapper, 'وضعیت با موفقیت تغییر کرد', true);
            } else {
                element.prop('checked', elementValue);
                showStatusMessage(wrapper, 'تغییر وضعیت با خطا مواجه شد', false);
            }
        },
        error: function() {
            element.prop('checked', elementValue);
            showStatusMessage(wrapper, 'خطای ارتباط با سرور', false);
        }
    });
}

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
