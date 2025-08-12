@if(session('toast-success'))
    <section class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position: fixed; top: 20px; right: 20px; min-width: 250px; z-index: 1050;">
        <section class="toast-body py-3 d-flex bg-success text-white rounded">
            <strong class="ml-auto">{{ session('toast-success') }}</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </section>
    </section>

    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>
@endif
