$(document).ready(function() {
    $('.toggle-approve').click(function(e) {
        e.preventDefault(); // جلوی submit معمولی فرم رو میگیره

        var button = $(this);
        var commentId = button.data('id');
        var form = $('#approve-' + commentId);
        var url = form.attr('action');
        var token = form.find('input[name="_token"]').val();

        $.ajax({
            url: url,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            success: function(data) {
                if (data.approved !== undefined) {
                    if (data.approved) {
                        button.removeClass('btn-warning').addClass('btn-success');
                        button.html('<i class="fa fa-check"></i> تایید شده');
                        button.attr('title', 'این کامنت تایید شده است');
                    } else {
                        button.removeClass('btn-success').addClass('btn-warning');
                        button.html('<i class="fa fa-clock"></i> تایید نشده');
                        button.attr('title', 'این کامنت هنوز تایید نشده');
                    }
                }
            },
            error: function(err) {
                console.error(err);
                $('body').append(`
                    <div class="toast align-items-center text-white bg-danger border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                عملیات تایید انجام نشد!
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `);

                var toastEl = $('.toast').last()[0];
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    });
});
