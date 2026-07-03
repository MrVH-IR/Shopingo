@if(session()->has('bootstrap-error'))
    <div class="container mt-4">
        <div class="card border-0 shadow rounded-4 overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-danger d-flex justify-content-center align-items-center"
                         style="width:60px;height:60px;">
                        <i class="fa-solid fa-circle-xmark text-white fs-3"></i>
                    </div>

                    <div class="ms-3 flex-grow-1">
                        <h5 class="mb-2 fw-bold text-danger">
                            {{ session('bootstrap-error.status') }}
                        </h5>

                        <p class="mb-0 text-muted">
                            {{ session('bootstrap-error.message') }}
                        </p>
                    </div>

                    @if(session('bootstrap-error.link'))
                        <a href="{{ session('bootstrap-error.link') }}"
                           class="btn btn-danger rounded-pill">
                            مشاهده
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
