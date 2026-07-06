function toggleReceiverFields(checkbox) {
    const fields = document.getElementById('receiver-fields');
    const inputs = fields.querySelectorAll('input');

    if (checkbox.checked) {
        // پر کردن خودکار با اطلاعات کاربر (در صورت وجود)
        fields.style.opacity = '0.5';
        fields.style.pointerEvents = 'none';
        // می‌توانید با AJAX اطلاعات کاربر را پر کنید
    } else {
        fields.style.opacity = '1';
        fields.style.pointerEvents = 'auto';
    }
}

$(document).ready(function() {
    $('#province').change(function() {
        const provinceId = $(this).val();
        const url = $(this).find(':selected').data('url');

        if (!provinceId) {
            $('#city').empty().append('<option value="">ابتدا استان را انتخاب کنید</option>');
            return;
        }

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            cache: true,
            success: function(response) {
                if (response.status === true) {
                    let cities = response.cities;
                    let citySelect = $('#city');
                    citySelect.empty();

                    citySelect.append('<option value="">انتخاب شهر...</option>');

                    cities.forEach(function(city) {
                        citySelect.append($('<option></option>').val(city.id).text(city.name));
                    });

                    if (cities.length === 0) {
                        citySelect.append('<option value="">شهری یافت نشد</option>');
                    }
                } else {
                    errorToast('خطا پیش آمده است');
                }
            },
            error: function(xhr) {
                errorToast('خطا در ارتباط با سرور');
            }
        });
    });
});
