@php
    $totalProductPrice = 0;
    $totalDiscount = 0;

    foreach ($cartItems as $cartItem) {
        $totalProductPrice += $cartItem->cartItemProductPrice() * $cartItem->numbers;
        $totalDiscount += $cartItem->cartItemProductDiscount() * $cartItem->numbers;
    }

    $finalPrice = $totalProductPrice - $totalDiscount;
@endphp

<div class="sticky top-5">
    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6">
            <div class="flex items-center gap-3 text-white">
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold">
                        خلاصه سفارش
                    </h2>
                    <p class="text-sm text-blue-100">
                        بررسی نهایی قبل از پرداخت
                    </p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-6 space-y-5">
            <div class="flex justify-between">
                <span class="text-gray-500">
                    قیمت کالاها ({{ $cartItems->count() }})
                </span>

                <span class="font-semibold">
                    {{ priceFormat($totalProductPrice) }} تومان
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">
                    تخفیف کالاها
                </span>
                @if($totalDiscount > 0)
                    <span class="font-bold text-red-500">
                    -{{ priceFormat($totalDiscount) }} تومان
                    </span>
                @else
                    <span class="font-bold text-red-500">-</span>
                @endif
            </div>
            <div class="flex justify-between">
            @if($order->commonDiscount()->get() !== null)
                <span class="text-gray-500">میزان تخفیف عمومی</span>
                <span class="font-bold text-red-500">{{ priceFormat($order->commonDiscount->discount) }} %</span>
            @else
                    <span class="text-gray-500">میزان تخفیف عمومی</span>
                    <span class="font-bold text-red-500">-</span>
            @endif
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">
                    هزینه ارسال
                </span>
                <span class="font-bold text-amber-500">
                    {{ priceFormat($order->delivery->amount) }} تومان
                </span>
            </div>
            @if($order->coupon()->get() !== null)
                <div class="flex justify-between">
                <span class="text-gray-500">
                    کد تخفیف
                </span>
                    <span class="font-bold text-emerald-600">
                    -{{ priceFormat($order->order_coupon_discount_amount) }} تومان
                </span>
                </div>
            @else
                <div class="flex justify-between">
                <span class="text-gray-500">
                    کد تخفیف
                </span>
                    <span class="font-bold text-emerald-600">
                        -
                    </span>
                </div>
            @endif

            <div class="border-t border-dashed pt-5">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold">
                        مبلغ نهایی
                    </span>
                    <span class="text-2xl font-black text-blue-600">
                        {{ priceFormat($order->order_final_amount) }} تومان
                    </span>
                </div>
            </div>

            {{-- Info --}}
            <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4">
                <div class="flex gap-3">
                    <i class="fa-solid fa-shield-halved text-blue-600 mt-1"></i>
                    <div>
                        <h5 class="font-bold text-blue-700">
                            پرداخت امن
                        </h5>
                        <p class="text-sm text-blue-600 mt-1 leading-6">
                            تمامی پرداخت‌ها از طریق درگاه امن بانکی انجام می‌شود و اطلاعات شما رمزنگاری خواهد شد.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Payment Button --}}
            <button
                id="payment-button"
                disabled
                class="w-full rounded-2xl bg-gray-300 text-gray-600 font-bold py-4 transition-all duration-300">
                <i class="fa-solid fa-circle-info ml-2"></i>
                ابتدا روش پرداخت را انتخاب کنید
            </button>
        </div>
    </div>
</div>
