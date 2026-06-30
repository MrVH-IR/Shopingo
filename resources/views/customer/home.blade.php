@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>فروشگاه شاپینگو</title>
@endsection

@section('content')

        <section class="container-xxl my-4">
            <section class="row">
                <section class="col-md-8 pe-md-1 ">
                    <section id="slideshow" class="owl-carousel owl-theme">
                    @foreach($homePage['banners']['0'] as $banner)
                            <section class="item"><a class="w-100 d-block h-auto text-decoration-none" href="{{ urldecode($banner->link) }}"><img class="w-100 rounded-2 d-block h-auto" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}"></a></section>
                    @endforeach
                    </section>
                </section>
                <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach($homePage['banners']['1'] as $banner)
                        <section class="mb-2"><a href="{{ urldecode($banner->link) }}" class="d-block"><img class="w-100 rounded-2" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}"></a></section>
                @endforeach
                </section>
            </section>
        </section>
        <!-- end slideshow -->



        <!-- start product lazy load -->
        <section class="mb-3">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>پربازدیدترین کالاها</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="#">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach($homePage['products'] as $product)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                                <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a></section>
                                                <a class="product-link" href="{{ route('customer.market.product' , $product->slug) }}">
                                                    <section class="product-image">
                                                        <img class="" src="{{ asset($product->image['indexArray']['medium']) }}" alt="{{ $product->name }}">
                                                    </section>
                                                    <section class="product-name"><h3>{{ Str::limit($product->name , 12) }}</h3></section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-discount">
                                                            <span class="product-old-price">165,000 </span>
                                                            <span class="product-discount-amount">46%</span>
                                                        </section>
                                                        <section class="product-price">{{ priceFormat($product->price) }} تومان </section>
                                                    </section>
                                                    <section class="product-colors">
                                                        <section class="product-colors-item" style="background-color: yellow;"></section>
                                                        <section class="product-colors-item" style="background-color: green;"></section>
                                                        <section class="product-colors-item" style="background-color: white;"></section>
                                                        <section class="product-colors-item" style="background-color: blue;"></section>
                                                        <section class="product-colors-item" style="background-color: red;"></section>
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



        <!-- start ads section -->
        <section class="mb-3">
            <section class="container-xxl">
                <!-- two column-->
                <section class="row py-4">
                    @foreach($homePage['banners']['2'] as $banner)
                        <section class="col-12 col-md-6 mt-2 mt-md-0"><a href="{{ urldecode($banner->link) }}"><img class="d-block rounded-2 w-100" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}"></a></section>
                    @endforeach
                </section>

            </section>
        </section>
        <!-- end ads section -->


        <!-- start product lazy load -->
        <section class="mb-3">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>پیشنهاد آمازون به شما</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <a href="#">مشاهده همه</a>
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                    @foreach($homePage['getOfferProducts'] as $offerProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>
                                                <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی"><i class="fa fa-heart"></i></a></section>
                                                <a class="product-link" href="#">
                                                    <section class="product-image">
                                                        <img class="" src="{{ asset($offerProduct->image['indexArray']['medium']) }}" alt="{{ $offerProduct->name }}">
                                                    </section>
                                                    <section class="product-colors"></section>
                                                    <section class="product-name"><h3>{{ Str::limit($offerProduct->name , 12) }}</h3></section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-discount">
                                                            <span class="product-old-price">342,000 </span>
                                                            <span class="product-discount-amount">22%</span>
                                                        </section>
                                                        <section class="product-price">{{ priceFormat($offerProduct->price) }} تومان</section>
                                                    </section>
                                                    <section class="product-colors">
                                                        <section class="product-colors-item" style="background-color: white;"></section>
                                                        <section class="product-colors-item" style="background-color: blue;"></section>
                                                        <section class="product-colors-item" style="background-color: red;"></section>
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

        @if($homePage['banners']['3'])
            <!-- start ads section -->
            <section class="mb-3">
                <section class="container-xxl">
                    <!-- one column -->
                    <section class="row py-4">
                        @foreach($homePage['banners']['3'] as $banner)
                            <section class="col"><a href="{{ urldecode($banner->link) }}"><img class="d-block rounded-2 w-100" src="{{ asset($banner->image) }}" alt="{{ $banner->name }}"></a></section>
                        @endforeach
                    </section>

                </section>
            </section>
            <!-- end ads section -->
        @endif




        <!-- start brand part-->
        <section class="brand-part mb-4 py-4">
            <section class="container-xxl">
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex align-items-center">
                                <h2 class="content-header-title">
                                    <span>برندهای ویژه</span>
                                </h2>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="brands-wrapper py-4" >
                            <section class="brands dark-owl-nav owl-carousel owl-theme">
                                <section class="item">
                                    <section class="brand-item">
                                        @foreach($homePage['brands'] as $brand)
                                            <a href="#"><img class="rounded-2" src="{{ asset($brand->image['indexArray']['large']) }}" alt="{{ $brand->persian_name }}"></a>
                                        @endforeach
                                    </section>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
@endsection
