@if(session('alert-section-error'))
    <div class="alert alert-danger alert-dismissable fade show" role="alert">
        <h4 class="alert-heading">
            خطا &times;
        </h4>
        <hr>
        <p class="mb-0">
            {{ session('alert-section-error') }}
        </p>
        <button type="button" class="close position-absolute" data-dismiss="alert" aria-label="Close" style="top: 0.5rem; left: 1rem;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
