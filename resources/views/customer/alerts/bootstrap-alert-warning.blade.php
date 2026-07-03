@if(session()->has('bootstrap-warning'))
    <div class="container mt-4">
        <div class="card border-0 shadow rounded-4 overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-warning d-flex justify-content-center align-items-center"
                         style="width:60px;height:60px;">
                        <i class="fa-solid fa-triangle-exclamation text-dark fs-3"></i>
                    </div>

                    <div class="ms-3 flex-grow-1">
                        <h5 class="mb-2 fw-bold text-warning">
                            {{ session('bootstrap-warning.status') }}
                        </h5>

                        <p class="mb-0 text-muted">
                            {{ session('bootstrap-warning.message') }}
                        </p>
                    </div>

                    @if(session('bootstrap-warning.link'))
                        <a href="{{ session('bootstrap-warning.link') }}"
                           class="btn btn-warning rounded-pill">
                            مشاهده
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
