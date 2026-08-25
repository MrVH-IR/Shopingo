<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.1/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin-assets/js/grid.js') }}"></script>
<script>
    let notificationDropDown = document.getElementById('header-notification-toggle');
    notificationDropDown.addEventListener('click', function() {
        $.ajax({
            type: 'POST',
            url: '/admin/notification/read-all',
            data: {_token: "{{ csrf_token()}}"},
            success: function() {
                // console.log("notif read");
            }
        });
    });
</script>
