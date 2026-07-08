<section
    class="header-cart-dropdown bg-white rounded-4 shadow-lg border overflow-hidden">
    {{-- Header --}}
    <section class="d-flex justify-content-between align-items-center p-3 border-bottom bg-light">
        <strong>
            <i class="fas fa-shopping-cart text-danger me-2 mr-5"></i>
            {{ $cartItems->count() }}
            کالا
        </strong>
        <a
            href="{{ route('customer.sales-process.cart') }}"
            class="text-decoration-none small">
            مشاهده سبد
        </a>
    </section>
    {{-- Body --}}
    <section
        style="max-height:350px;overflow-y:auto;">
        @foreach($cartItems as $cartItem)
            <a
                href="{{ route('customer.market.product',$cartItem->product->slug) }}"
                class="d-flex align-items-center p-3 border-bottom text-decoration-none text-dark">
                <img
                    src="{{ asset($cartItem->product->image['indexArray']['medium']) }}"
                    style="width:70px;height:70px;object-fit:contain;"
                    class="rounded bg-light">
                <section class="flex-grow-1 px-3">
                    <div class="fw-semibold small">
                        {{ Str::limit($cartItem->product->name,45) }}
                    </div>
                    <div class="text-muted small mt-1">
                        تعداد :
                        {{ $cartItem->numbers }}
                    </div>
                    <div class="text-danger fw-bold mt-2">
                        {{ priceFormat($cartItem->cartItemFinalPrice()) }}
                        تومان
                    </div>
                </section>
            </a>
        @endforeach
    </section>
    {{-- Footer --}}
    <section class="p-3 bg-light">
        <section class="d-flex justify-content-between mb-3">
            <span>
                مبلغ نهایی
            </span>
            <strong class="text-danger">

                {{ priceFormat($cartItems->sum(fn($i)=>$i->cartItemFinalPrice())) }}
                تومان
            </strong>
        </section>
        <a
            href="{{ route('customer.sales-process.cart') }}"
            class="btn btn-danger w-100 rounded-pill">

            ادامه خرید

        </a>
    </section>
</section>
