@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>{{ $product->name }}</title>
@endsection

@section('content')

    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <form id="add-to-cart" action="{{ route('customer.sales-process.add-to-cart', $product->slug) }}" method="POST" class="product-info">
                @csrf
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>{{ $product->name }}</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4">
                            <section class="content-wrapper bg-white rounded-4 shadow-sm p-4">
                                <section class="product-gallery">
                                    {{-- Main Image --}}
                                    <div class="product-gallery-selected-image">
                                        <img
                                            id="mainProductImage"
                                            src="{{ asset($product->image['indexArray']['medium']) }}"
                                            alt="{{ $product->name }}"
                                        >
                                    </div>
                                    {{-- Thumbnails --}}
                                    <div class="product-gallery-thumbs">
                                        {{-- Product Image --}}
                                        <img
                                            class="product-gallery-thumb active"
                                            src="{{ asset($product->image['indexArray']['medium']) }}"
                                            data-image="{{ asset($product->image['indexArray']['medium']) }}"
                                            alt="{{ $product->name }}"
                                        >
                                        @foreach($product->images as $image)
                                            <img
                                                class="product-gallery-thumb"
                                                src="{{ asset($image->image['indexArray']['medium']) }}"
                                                data-image="{{ asset($image->image['indexArray']['medium']) }}"
                                                alt="{{ $product->name }}"
                                            >
                                        @endforeach
                                    </div>
                                </section>
                            </section>
                        </section>
                        <!-- end image gallery -->

                        <!-- start product info -->
                        <section class="col-md-5">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{ $product->name }}
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-info">
                                    <p>رنگ انتخاب شده: <span id="selected_color_name"></span></p>
                                    <p>
                                        @forelse($product->colors as $key => $color)
                                            <label for="{{ 'color_' . $color->id }}"
                                                   style="background-color: {{ $color->color }};"
                                                   class="product-info-colors me-1"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="bottom"
                                                   title="{{ $color->color_name }}"></label>
                                            <input type="radio" name="color" id="{{ 'color_' . $color->id }}"
                                                   class="d-none" value="{{ $color->id }}"
                                                   data-color-name="{{ $color->color_name }}"
                                                   data-color-price="{{ $color->price_increase }}"
                                                   @if($key == 0) checked @endif>
                                        @empty
                                            <span class="text-muted">هیچ رنگی برای این محصول ثبت نشده است.</span>
                                        @endforelse
                                    </p>
                                    <div class="product-guarantee mt-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fa fa-shield-alt text-success me-2"></i>
                                            <span class="fw-bold">انتخاب گارانتی</span>
                                        </div>
                                        @forelse($product->guarantees as $key => $guarantee)
                                            <label class="guarantee-card">
                                                <input
                                                    type="radio"
                                                    name="guarantee"
                                                    value="{{ $guarantee->id }}"
                                                    data-guarantee-price="{{ $guarantee->price_increase }}"
                                                    @checked($key == 0)
                                                >
                                                <div class="guarantee-content">
                                                    <div>
                                                        <div class="guarantee-title">
                                                            {{ $guarantee->name }}
                                                        </div>
                                                        @if($guarantee->price_increase > 0)
                                                            <small class="text-success">
                                                                +{{ number_format($guarantee->price_increase) }} تومان
                                                            </small>
                                                        @else
                                                            <small class="text-muted">
                                                                بدون افزایش قیمت
                                                            </small>
                                                        @endif
                                                    </div>
                                                    <i class="fa fa-check-circle guarantee-check"></i>
                                                </div>
                                            </label>
                                        @empty
                                            <div class="alert alert-light border">
                                                این محصول فاقد گارانتی است.
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="product-actions-card mt-4">
                                        {{-- موجودی --}}
                                        <div class="product-stock mb-3">
                                            @if($product->marketable_number > 0)
                                                <div class="stock-badge in-stock">
                                                    <i class="fa fa-check-circle"></i>
                                                    <span>موجود در انبار</span>
                                                    <small class="ms-auto">
                                                        {{ $product->marketable_number }} عدد باقی مانده
                                                    </small>
                                                </div>
                                            @else
                                                <div class="stock-badge out-stock">
                                                    <i class="fa fa-times-circle"></i>
                                                    <span>ناموجود</span>
                                                </div>
                                            @endif
                                        </div>
                                        @php
                                            $isFavorite = auth()->check() && $product->user->contains(auth()->id());
                                        @endphp
                                        <button
                                            type="button"
                                            class="wishlist-btn mb-4 favorite-btn"
                                            data-url="{{ route('customer.market.product.favorite', $product) }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="left"
                                            title="{{ $isFavorite ? 'حذف از علاقه‌مندی' : 'افزودن به علاقه‌مندی' }}">
                                            <i class="fa fa-heart {{ $isFavorite ? 'text-danger' : '' }}"></i>
                                            <span>
                                                {{ $isFavorite ? 'در علاقه‌مندی‌ها' : 'افزودن به علاقه‌مندی‌ها' }}
                                            </span>
                                        </button>
                                        {{-- تعداد --}}
                                        <div class="mb-4">
                                            <label class="small text-muted mb-2 d-block">
                                                تعداد
                                            </label>
                                            <section class="cart-product-number">
                                                <button class="cart-number cart-number-down" type="button">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input
                                                    type="number"
                                                    id="number"
                                                    name="number"
                                                    value="1"
                                                    readonly>
                                                <button class="cart-number cart-number-up" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </section>
                                        </div>
                                        {{-- اطلاعیه --}}
                                        <div class="shipping-info">
                                            <div class="shipping-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold mb-1">
                                                    اطلاعات ارسال
                                                </div>
                                                <small>
                                                    هزینه ارسال پس از انتخاب آدرس و روش ارسال محاسبه خواهد شد.
                                                    مبلغ نهایی در مرحله پرداخت نمایش داده می‌شود.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </section>
                        <!-- end product info -->
                        <section class="col-lg-3 col-md-4 mt-4 mt-md-0">
                            <section class="cart-total-price">

                                {{-- Header --}}
                                <div class="price-card-header">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span>خلاصه سفارش</span>
                                </div>

                                {{-- Product Price --}}
                                <div class="price-row">
                                <span class="price-label">
                                    قیمت کالا
                                </span>
                                    <span class="price-value">
                                    <span
                                        id="product_price"
                                        data-product-original-price="{{ $product->price }}"
                                    >
                                        {{ priceFormat($product->price) }}
                                    </span>
                                    <small>تومان</small>
                                    </span>
                                </div>
                                {{-- Discount --}}
                                @if($product->activeAmazingSales())
                                    <div class="price-row">
                                    <span class="price-label">
                                        تخفیف
                                    </span>
                                        <span
                                            id="product-discount-price"
                                            class="price-discount"
                                            data-product-discount-price="{{ $product->price * ($product->activeAmazingSales()->percentage / 100) }}"
                                        >
                                    - {{ priceFormat($product->price * ($product->activeAmazingSales()->percentage / 100)) }}
                                    <small>تومان</small>
                                </span>
                                    </div>
                                @endif
                                <hr>
                                {{-- Final Price --}}
                                <div class="price-total">
                                    <small class="text-muted">
                                        مبلغ قابل پرداخت
                                    </small>
                                    <div class="price-total-value">
                                    <span id="final_price">
                                        {{ priceFormat($product->price - ($product->price * ($product->activeAmazingSales()?->percentage / 100))) }}
                                    </span>
                                        <small>تومان</small>
                                    </div>
                                </div>
                                {{-- Cart Button --}}
                                @if($product->marketable_number > 0)
                                    <button
                                        type="submit"
                                        onclick="document.getElementById('add-to-cart').submit();"
                                        id="next-level"
                                        class="btn btn-success add-to-cart-btn w-100 mt-4">
                                        <i class="fa fa-cart-plus me-2"></i>
                                        افزودن به سبد خرید
                                    </button>
                                @else
                                    <button
                                        class="btn btn-secondary w-100 mt-4"
                                        disabled>
                                        <i class="fa fa-ban me-2"></i>
                                        این محصول موجود نیست
                                    </button>
                                @endif
                            </section>
                        </section>
                    </section>
                </section>
            </section>
            </form>
        </section>
    </section>
    <!-- end cart -->



    <!-- start product lazy load -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                @foreach($relatedProducts as $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <button data-bs-toggle="tooltip"
                                                            type="submit"
                                                            data-bs-placement="left"
                                                            title="افزودن به سبد خرید"><i
                                                            class="fa fa-cart-plus"></i></button></section>
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button
                                                            type="button"
                                                            class="favorite-btn"
                                                            data-url="{{ route('customer.market.product.favorite', $relatedProduct) }}"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="left"
                                                            title="{{ $relatedProduct->user->contains(auth()->id()) ? 'حذف از علاقه مندی' : 'افزودن به علاقه مندی' }}">
                                                            <i class="fa fa-heart {{ $relatedProduct->user->contains(auth()->id()) ? 'text-danger' : 'text-dark' }}"></i>
                                                        </button>
                                                    </section>
                                                @endguest
                                                @auth
                                                    @if($relatedProduct->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                type="button"
                                                                class="favorite-btn"
                                                                data-url="{{ route('customer.market.product.favorite', $relatedProduct) }}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="left"
                                                                title="{{ $relatedProduct->user->contains(auth()->id()) ? 'حذف از علاقه مندی' : 'افزودن به علاقه مندی' }}">
                                                                <i class="fa fa-heart {{ $relatedProduct->user->contains(auth()->id()) ? 'text-danger' : 'text-dark' }}"></i>
                                                            </button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                type="button"
                                                                class="favorite-btn"
                                                                data-url="{{ route('customer.market.product.favorite', $relatedProduct) }}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="left"
                                                                title="{{ $relatedProduct->user->contains(auth()->id()) ? 'حذف از علاقه مندی' : 'افزودن به علاقه مندی' }}">
                                                                <i class="fa fa-heart {{ $relatedProduct->user->contains(auth()->id()) ? 'text-danger' : 'text-dark' }}"></i>
                                                            </button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                <a class="product-link"
                                                   href="{{ route('customer.market.product' , $relatedProduct->slug) }}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{ asset($relatedProduct->image['indexArray']['medium']) }}"
                                                             alt="">
                                                    </section>
                                                    <section class="product-name"><h3>{{ $relatedProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        <section
                                                            class="product-price">{{ priceFormat($relatedProduct->price) }}
                                                            تومان
                                                        </section>
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($relatedProduct->colors()->get() as $color)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{ $color->color }};"></section>
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
    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- ================= Navigation ================= -->
                        <section id="introduction-features-comments" class="product-navigation mb-4">

                            <nav class="product-nav">

                                <a href="#introduction" class="product-nav-item active">
                                    <i class="fa fa-file-alt"></i>
                                    معرفی
                                </a>

                                <a href="#features" class="product-nav-item">
                                    <i class="fa fa-list-ul"></i>
                                    مشخصات فنی
                                </a>

                                <a href="#comments" class="product-nav-item">
                                    <i class="fa fa-comments"></i>
                                    دیدگاه‌ها
                                </a>

                            </nav>

                        </section>


                        <section class="py-4">

                            {{-- ================= Introduction ================= --}}

                            <section
                                id="introduction"
                                class="product-section mb-5"
                            >

                                <h2 class="section-title">

                                    معرفی محصول

                                </h2>

                                <div class="product-introduction mt-4">

                                    {!! $product->description !!}

                                </div>

                            </section>


                            {{-- ================= Features ================= --}}

                            <section
                                id="features"
                                class="product-section"
                            >

                                <h2 class="section-title">

                                    مشخصات فنی

                                </h2>

                                <div class="feature-list mt-4">

                                    @foreach($product->values as $value)

                                        <div class="feature-item">

                                            <div class="feature-name">

                                                {{ $value->attribute->name }}

                                            </div>

                                            <div class="feature-value">

                                                {{ json_decode($value->value)->value }}

                                                {{ $value->attribute->unit }}

                                            </div>

                                        </div>

                                    @endforeach


                                    @foreach($product->metas as $meta)

                                        <div class="feature-item">

                                            <div class="feature-name">

                                                {{ $meta->meta_key }}

                                            </div>

                                            <div class="feature-value">

                                                {{ $meta->meta_value }}

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </section>

                        </section>

                        <!-- start vontent header -->
                        <section id="comments" class="content-header mt-2 mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    دیدگاه ها
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <section class="product-comments mb-4">

                            <section class="comment-add-wrapper">
                                <button class="comment-add-button" type="button" data-bs-toggle="modal"
                                        data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن دیدگاه
                                </button>
                                <!-- start add comment Modal -->
                                <section class="modal fade" id="add-comment" tabindex="-1"
                                         aria-labelledby="add-comment-label" aria-hidden="true">
                                    <section class="modal-dialog">
                                        <section class="modal-content">
                                            <section class="modal-header">
                                                <h5 class="modal-title" id="add-comment-label"><i
                                                        class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </section>
                                            @guest
                                                <section class="modal-body">
                                                    <p>کاربر گرامی برای ثبت نظر ابتدا وارد حساب کاربری خود شوید <br>
                                                        <a href="{{ route('auth.customer.login-register-form') }}">لینک
                                                            ثبت نام یا ورود</a>
                                                    </p>
                                                </section>
                                            @endguest
                                            @auth
                                                <form class="row"
                                                      action="{{ route('customer.market.add-comment' , $product->slug) }}"
                                                      method="POST">
                                                    <section class="modal-body">
                                                        @csrf
                                                        <section class="col-12 mb-2">
                                                            <label for="comment" class="form-label mb-1">دیدگاه
                                                                شما</label>
                                                            <textarea class="form-control form-control-sm" id="comment"
                                                                      placeholder="دیدگاه شما ..." rows="4"
                                                                      name="comment"></textarea>
                                                        </section>
                                                        @error('comment')
                                                        <section>
                                                            <div class="alert alert-danger">
                                                                {{ $message }}
                                                            </div>
                                                        </section>
                                                        @enderror
                                                    </section>
                                                    <section class="modal-footer py-1">
                                                        <button type="submit" class="btn btn-sm btn-primary">ثبت
                                                            دیدگاه
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                    </section>
                                                </form>
                                            @endauth
                                        </section>
                                    </section>
                                </section>
                            </section>
                            @foreach($product->getActiveComment() as $activeComment)
                                <section class="product-comment">
                                    <section class="product-comment-header d-flex justify-content-start">
                                        <section
                                            class="product-comment-date">{{ jalaliDate($activeComment->created_at , 'Y/m/d') }}</section>
                                        <section
                                            class="product-comment-title">{{ $activeComment->author?->first_name}} {{ $activeComment->author?->last_name }}</section>
                                    </section>
                                    <section
                                        class="product-comment-body @if($activeComment->answers()->count() > 0) border-bottom @endif">
                                        {!! $activeComment->body !!}
                                    </section>
                                    <section class="comment-replies ms-5 ps-4 border-start">
                                        @foreach($activeComment->answers as $answerComment)

                                            <section class="product-comment mt-3">
                                                <section class="product-comment-header d-flex justify-content-start">
                                                    <section class="product-comment-date">
                                                        {{ jalaliDate($answerComment->created_at , 'Y/m/d') }}
                                                    </section>

                                                    <section class="product-comment-title">
                                                        {{ $answerComment->author?->first_name }}
                                                        {{ $answerComment->author?->last_name }}
                                                    </section>
                                                </section>

                                                <section class="product-comment-body">
                                                    {!! $answerComment->body !!}
                                                </section>
                                            </section>
                                        @endforeach
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end description, features and comments -->

    @include('customer.notifications.toast')

@endsection
@section('script')
    <script src="{{ asset('customer-assets/js/utils.js') }}"></script>
    <script src="{{ asset('customer-assets/js/product.js') }}"></script>
    <script src="{{ asset('customer-assets/js/addToFavorite.js') }}"></script>
@endsection
