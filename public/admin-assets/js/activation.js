function changeActivation(userId) {
    var element = $("#activation-" + userId);
    var url = element.data('url');
    var elementValue = !element.prop('checked');
    var wrapper = element.closest('.activation-wrapper');

    $.ajax({
        url: url,
        type: "GET",
        success: function(response) {
            element.prop('checked', response.checked);
            showStatusMessage(wrapper, response.status ? 'وضعیت با موفقیت تغییر کرد' : 'خطا', response.status);
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
