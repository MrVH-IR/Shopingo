@if(session('swal-error'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: "error",
                title: "خطا!",
                text: "{{ session('swal-error') }}",
                confirmButtonText: 'باشه',
                footer: '<a href="/support">چطور حلش کنم؟</a>'
            });
        });
    </script>
@endif
