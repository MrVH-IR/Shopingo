@if(session()->has('bootstrap-info'))
    <div class="container mt-4">
        <div class="card border-0 shadow rounded-4 overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-info d-flex justify-content-center align-items-center"
                         style="width:60px;height:60px;">
                        <i class="fa-solid fa-circle-info text-white fs-3"></i>
                    </div>

                    <div class="ms-3 flex-grow-1">
                        <h5 class="mb-2 fw-bold text-info">
                            {{ session('bootstrap-info.status') }}
                        </h5>

                        <p class="mb-0 text-muted">
                            {{ session('bootstrap-info.message') }}
                        </p>
                    </div>

                    @if(session('bootstrap-info.link'))
                        <a href="{{ session('bootstrap-info.link') }}"
                           class="btn btn-info text-white rounded-pill">
                            مشاهده
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
