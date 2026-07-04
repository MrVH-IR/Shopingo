@extends('customer.layouts.master-two-col')

@section('head-tag')
<title>سبد خرید شما</title>
@endsection


@section('content')

<!-- start cart -->
<section class="mb-4">
    <section class="container-xxl" >
        <section class="row">
            <section class="col">
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>سبد خرید شما</span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                <section class="row mt-4">
                    <section class="col-md-9 mb-3">

                            <form id="cart_items" method="POST" class="content-wrapper bg-white p-3 rounded-2">
                                @csrf
                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp
                                @foreach($cartItems as $cartItem)
                                    @php
                                        $totalProductPrice += $cartItem->cartItemProductPrice();
                                        $totalDiscount += $cartItem->cartItemProductDiscount();
                                    @endphp
                                <section class="cart-item d-md-flex py-3">
                                    <section class="cart-img align-self-start flex-shrink-1"><img src="{{ asset($cartItem->product->image['indexArray']['medium']) }}" alt=""></section>
                                    <section class="align-self-start w-100">
                                        <p class="fw-bold">{{ $cartItem->product->name }}</p>
                                        @if(!empty($cartItem->color->color_name))
                                            <p><span style="background-color: {{ $cartItem->color->color }};" class="cart-product-selected-color me-1"></span> <span> {{ $cartItem->color->color_name }}</span></p>
                                        @else
                                            <p><span>رنگ منتخب وجود ندارد</span></p>
                                        @endif
                                        @if(!empty($cartItem->guarantee->name))
                                            <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span> {{ $cartItem->guarantee->name }}</span></p>
                                        @else
                                            <p><span>گارانتی برای این محصول پیدا نشد</span></p>
                                        @endif
                                        <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار: {{ $cartItem->product->marketable_number }}</span></p>
                                        <section>
                                            <section class="cart-product-number d-inline-block ">
                                                <button class="cart-number cart-number-down" type="button">-</button>
                                                <input class="number" data-product-price="{{ $cartItem->cartItemProductPrice() }}"
                                                       data-product-discount="{{ $cartItem->cartItemProductDiscount() }}"
                                                       type="number" min="1" max="5" step="1" value="{{ $cartItem->numbers }}" readonly="readonly">
                                                <button class="cart-number cart-number-up" type="button">+</button>
                                            </section>
                                            <button
                                                type="button"
                                                data-id="{{ $cartItem->id }}"
                                                class="btn btn-link text-decoration-none ms-4 cart-delete p-0 border-0">
                                                <i class="fa fa-trash-alt"></i>
                                                حذف از سبد
                                            </button>
                                        </section>
                                    </section>
                                    <section class="align-self-end flex-shrink-1">
                                        @if(!empty($cartItem->product->activeAmazingSales()))
                                            <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف {{ priceFormat($cartItem->cartItemProductDiscount()) }}</section>
                                        @endif
                                        <section class="text-nowrap fw-bold">{{ priceFormat($cartItem->cartItemProductPrice()) }} تومان</section>
                                    </section>
                                </section>
                                @endforeach
                            </form>
                    </section>
                    <section class="col-md-3">
                        <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                <p class="text-muted" id="total_product_price">{{ priceFormat($totalProductPrice) }} تومان</p>
                            </section>

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">تخفیف کالاها</p>
                                <p class="text-danger fw-bolder" id="total_discount">{{ priceFormat($totalDiscount) }} تومان</p>
                            </section>
                            <section class="border-bottom mb-3"></section>
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">جمع سبد خرید</p>
                                <p class="fw-bolder" id="total_price">{{ priceFormat($totalProductPrice - $totalDiscount) }} تومان</p>
                            </section>

                            <p class="my-3">
                                <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                            </p>


                            <section class="">
                                <a href="address.html" class="btn btn-danger d-block">تکمیل فرآیند خرید</a>
                            </section>

                        </section>
                    </section>
                </section>
            </section>
        </section>

    </section>
</section>
<!-- end cart -->

<section class="mb-4">
    <section class="container-xxl" >
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>کالاهای مرتبط با سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="lazyload-wrapper" >
                        <section class="lazyload light-owl-nav owl-carousel owl-theme">

                            @foreach($relatedProducts as $relatedProduct)
                            <section class="item">
                                <section class="lazyload-item-wrapper">
                                    <section class="product">
                                        <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                        @php
                                            $isFavorite = auth()->check() && $relatedProduct->user->contains(auth()->id());
                                        @endphp
                                        <section class="product-add-to-favorite">
                                            <button class="wishlist-btn mb-4 favorite-btn pl-2"
                                                    style="border: none; padding-left: 2px"
                                                    data-url="{{ route('customer.market.product.favorite', $relatedProduct->slug) }}"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="left"
                                                    title="{{ $isFavorite ? 'حذف از علاقه‌مندی' : 'افزودن به علاقه‌مندی' }}">
                                                <i class="fa fa-heart {{ $isFavorite ? 'text-danger' : '' }}"></i>
                                            </button>
                                        </section>
                                        <a class="product-link" href="{{ route('customer.market.product' , $relatedProduct->slug) }}">
                                            <section class="product-image">
                                                <img class="" src="{{ asset($relatedProduct->image['indexArray']['medium']) }}" alt="">
                                            </section>
                                            <section class="product-name"><h3>{{ $relatedProduct->name }}</h3></section>
                                            <section class="product-price-wrapper">
                                                <section class="product-price">{{ priceFormat($relatedProduct->price) }} تومان</section>
                                            </section>
                                            <section class="product-colors">
                                                @foreach($relatedProduct->colors as $color)
                                                    <section class="product-colors-item" style="background-color: {{ $color->color }};"></section>
                                                @endforeach
                                            </section>
                                        </a>
                                    </section>
                                </section>
                            </section>
                            @endforeach

                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>

@include('customer.notifications.toast')
@endsection
@section('script')
    <script src="{{ asset('customer-assets/js/utils.js') }}"></script>
    <script src="{{ asset('customer-assets/js/addToFavorite.js') }}"></script>
    <script src="{{ asset('customer-assets/js/cart.js') }}"></script>
@endsection
