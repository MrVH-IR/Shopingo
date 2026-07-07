@php
    $totalProductPrice = 0;
    $totalDiscount = 0;

    foreach ($cartItems as $cartItem) {
        $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->numbers;
        $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->numbers;
    }

    $finalPrice = $totalProductPrice - $totalDiscount;
@endphp

<section class="col-md-3">
    <section class="bg-white p-4 rounded-4 shadow-sm sticky-top" style="top:1rem;">

        <h4 class="fw-bold mb-4 d-flex align-items-center">
            <i class="fas fa-receipt text-primary me-2"></i>
            خلاصه سفارش
        </h4>

        {{-- قیمت کالا --}}
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">
                قیمت کالاها ({{ $cartItems->count() }})
            </span>
            <span>
                {{ priceFormat($totalProductPrice) }} تومان
            </span>
        </div>

        {{-- تخفیف --}}
        @if($totalDiscount > 0)
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">
                    تخفیف کالاها
                </span>

                <span class="text-danger fw-bold">
                    - {{ priceFormat($totalDiscount) }} تومان
                </span>
            </div>
        @endif

        {{-- جمع سبد --}}
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">
                جمع سبد خرید
            </span>

            <span
                id="subtotal-amount"
                data-amount="{{ $totalProductPrice - $totalDiscount }}"
                class="fw-semibold">
                {{ priceFormat($totalProductPrice - $totalDiscount) }} تومان
            </span>
        </div>

        {{-- ارسال --}}
        <div class="d-flex justify-content-between mb-3">
            <span class="text-muted">
                هزینه ارسال
            </span>

            <span
                id="shipping-amount"
                class="text-warning fw-bold">
                ۰ تومان
            </span>
        </div>

        <hr class="border-secondary-subtle">

        {{-- مبلغ نهایی --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="fw-bold fs-5">
                مبلغ قابل پرداخت
            </span>

            <span
                id="final-amount"
                class="fw-bold text-primary fs-5">
                {{ priceFormat($totalProductPrice - $totalDiscount) }} تومان
            </span>
        </div>

        {{-- توضیح --}}
        <div class="alert alert-light border small">
            <i class="fa fa-info-circle text-primary me-1"></i>
            هزینه ارسال پس از انتخاب آدرس و شیوه ارسال به‌صورت دقیق محاسبه خواهد شد.
        </div>

        {{-- دکمه --}}
        <div class="d-grid gap-2 mt-3">

            <form
                id="checkout-form"
                action="{{ route('customer.sales-process.payment') }}"
                method="GET"
                class="d-none"
            ></form>

            <button
                type="submit"
                id="next-level"
                class="btn btn-danger d-none py-2"
                onclick="document.getElementById('checkout-form').submit();"
            >
                ادامه فرآیند خرید
            </button>

        </div>

    </section>
</section>
