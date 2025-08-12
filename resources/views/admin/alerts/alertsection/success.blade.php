@if(session('alert-section-success'))
    <div class="alert alert-success alert-dismissible fade show position-relative" role="alert" style="padding-left: 3rem;">
        <h4 class="alert-heading">
            موفقیت
        </h4>
        <hr>
        <p class="mb-0">
            {{ session('alert-section-success') }}
        </p>
        <button type="button" class="close position-absolute" data-dismiss="alert" aria-label="Close" style="top: 0.5rem; left: 1rem;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
