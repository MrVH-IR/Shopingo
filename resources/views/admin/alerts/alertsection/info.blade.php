@if(session('alert-section-info'))
    <div class="alert alert-info alert-dismissable fade show" role="alert">
        <h4 class="alert-heading">
            اطلاعات &times;
        </h4>
        <hr>
        <p class="mb-0">
            {{ session('alert-section-info') }}
        </p>
        <button type="button" class="close position-absolute" data-dismiss="alert" aria-label="Close" style="top: 0.5rem; left: 1rem;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
