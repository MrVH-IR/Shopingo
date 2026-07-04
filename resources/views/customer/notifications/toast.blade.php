<section class="position-fixed top-0 start-0 p-4"
         style="z-index: 1000000 ;max-width:420px; margin-top: 120px">
    <section class="toast border-0 shadow-lg rounded-3"
             data-delay="6000"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">
        <section class="toast-body d-flex align-items-start bg-white rounded-3">
            <i class="fa fa-heart text-danger fs-4 me-3 mt-1"></i>
            <section class="flex-grow-1">
                <h6 class="mb-2 fw-bold text-dark">
                    ورود مورد نیاز است
                </h6>
                <p class="mb-3 text-muted">
                    برای افزودن این محصول به لیست علاقه‌مندی‌ها ابتدا وارد حساب کاربری خود شوید.
                </p>
                <a href="{{ route('auth.customer.login-register') }}"
                   class="btn btn-sm btn-primary">
                    ورود / ثبت‌نام
                </a>
            </section>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="toast"
                aria-label="Close">
            </button>
        </section>
    </section>
</section>
