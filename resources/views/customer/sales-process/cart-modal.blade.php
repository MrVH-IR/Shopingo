@php
    $totalProductPrice = 0;
    $totalDiscount = 0;
    foreach ($cartItems as $cartItem) {
        $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->numbers;
        $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->numbers;
    }
@endphp

<section class="col-md-3">
    <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
        <section class="d-flex justify-content-between align-items-center">
            <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
            <p class="text-muted">{{ priceFormat($totalProductPrice) }} تومان</p>
        </section>
        @if($totalDiscount !== 0.0)
            <section class="d-flex justify-content-between align-items-center">
                <p class="text-muted">تخفیف کالاها</p>
                <p class="text-danger fw-bolder">{{ priceFormat($totalDiscount) }} تومان</p>
            </section>
        @endif
        <section class="border-bottom mb-3"></section>

        <section class="d-flex justify-content-between align-items-center">
            <p class="text-muted">جمع سبد خرید</p>
            <p class="fw-bolder">{{ priceFormat($totalProductPrice - $totalDiscount) }} تومان</p>
        </section>

        <section class="d-flex justify-content-between align-items-center">
            <p class="text-muted">هزینه ارسال</p>
            <p class="text-warning">54,000 تومان</p>
        </section>

        <p class="my-3">
            <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
        </p>

        <section class="border-bottom mb-3"></section>

        <section class="d-flex justify-content-between align-items-center">
            <p class="text-muted">مبلغ قابل پرداخت</p>
            <p class="fw-bold">{{priceFormat($totalProductPrice - $totalDiscount) }} تومان</p>
        </section>

        <section class="">
            <section id="address-button" href="address.html" class="text-warning border border-warning text-center py-2 pointer rounded-2 d-block">آدرس و نحوه ارسال را انتخاب کن</section>
            <a id="next-level" href="payment.html" class="btn btn-danger d-none">ادامه فرآیند خرید</a>
        </section>

    </section>
</section>
