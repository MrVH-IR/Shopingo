@extends('customer.layouts.master-one-col')

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('customer-assets/css/home.css') }}">
@endsection

@section('content')

    <section class="max-w-screen-xl mx-auto px-4 my-6">

        {{-- Hero banners --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <section class="md:col-span-2">
                <section id="slideshow" class="owl-carousel owl-theme rounded-2xl overflow-hidden">
                    @forelse(($homePage['banners']['0'] ?? []) as $banner)
                        <section class="item">
                            <a class="block" href="{{ urldecode($banner->link) }}">
                                <img class="w-full h-auto rounded-2xl" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                            </a>
                        </section>
                    @empty
                        <section class="item flex items-center justify-center h-56 bg-gray-100 rounded-2xl text-gray-400 text-sm">
                            هیچ عکسی وجود ندارد
                        </section>
                    @endforelse
                </section>
            </section>

            <section class="flex flex-col gap-4">
                @forelse(($homePage['banners']['1'] ?? []) as $banner)
                    <a href="{{ urldecode($banner->link) }}" class="block rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <img class="w-full rounded-2xl" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                    </a>
                @empty
                    <section class="flex items-center justify-center h-full min-h-[10rem] bg-gray-100 rounded-2xl text-gray-400 text-sm">
                        هیچ عکسی وجود ندارد
                    </section>
                @endforelse
            </section>
        </section>
    </section>
    {{-- end slideshow --}}


    {{-- Most viewed products --}}
    <section class="max-w-screen-xl mx-auto px-4 mb-6">
        <section class="bg-white rounded-2xl shadow-sm p-5 md:p-6">
            <section class="flex justify-between items-center mb-5">
                <h2 class="flex items-center gap-2 text-lg font-bold text-gray-900">
                    <span class="w-1.5 h-5 rounded-full bg-indigo-500 inline-block"></span>
                    پربازدیدترین کالاها
                </h2>
                <a href="{{ route('products.products', ['sort' => '4']) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-1">
                    مشاهده همه <i class="fa fa-angle-left text-xs"></i>
                </a>
            </section>

            <section class="lazyload-wrapper">
                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                    @forelse($homePage['products'] as $product)
                        <section class="item">
                            <section class="lazyload-item-wrapper">
                                <section class="group relative border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow bg-white">

                                    {{-- Add to cart --}}
                                    <a href="#"
                                       class="absolute top-3 left-3 z-10 w-8 h-8 rounded-full bg-white/90 shadow flex items-center justify-center text-gray-600 hover:text-indigo-600 transition-colors"
                                       data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید">
                                        <i class="fa fa-cart-plus text-sm"></i>
                                    </a>

                                    {{-- Favorite --}}
                                    @php $isFavorite = auth()->check() && $product->user->contains(auth()->id()); @endphp
                                    <section class="absolute top-3 right-3 z-10">
                                        <button
                                            type="button"
                                            class="favorite-btn w-8 h-8 rounded-full bg-white/90 shadow flex items-center justify-center transition-colors"
                                            data-url="{{ route('customer.market.product.favorite', $product) }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="left"
                                            title="{{ $isFavorite ? 'حذف از علاقه مندی' : 'افزودن به علاقه مندی' }}">
                                            <i class="fa fa-heart text-sm {{ $isFavorite ? 'text-rose-500' : 'text-gray-400' }}"></i>
                                        </button>
                                    </section>

                                    <a class="block" href="{{ route('customer.market.product', $product->slug) }}">
                                        <section class="bg-gray-50 p-6 flex items-center justify-center h-40">
                                            <img class="max-h-full object-contain" src="{{ asset($product->image['indexArray']['medium']) }}" alt="{{ $product->name }}">
                                        </section>

                                        <section class="p-3">
                                            <h3 class="text-sm text-gray-800 font-medium mb-2 truncate">{{ Str::limit($product->name, 21) }}</h3>
                                            @if($product->activeAmazingSales())
                                            <section class="flex items-center gap-2 mb-1">
                                                <span class="text-xs text-gray-400 line-through">{{ priceFormat($product->price) }}</span>
                                                <span class="text-xs text-rose-600 bg-rose-50 px-1.5 py-0.5 rounded-full">{{ priceFormat($product->activeAmazingSales()->percentage) }} %</span>
                                            </section>
                                            <section class="text-sm font-bold text-gray-900">{{ priceFormat($product->price - $product->price * ($product->activeAmazingSales()->percentage / 100)) }} تومان</section>
                                            @else
                                                <section class="text-sm font-bold text-gray-900">{{ priceFormat($product->price)}} تومان</section>
                                            @endif
                                            <section class="flex items-center gap-1 mt-2">
                                                @foreach($product->colors()->get() as $color)
                                                    <span class="w-3.5 h-3.5 rounded-full border border-gray-200" style="background-color: {{ $color->color }};"></span>
                                                @endforeach
                                            </section>
                                        </section>
                                    </a>
                                </section>
                            </section>
                        </section>
                    @empty
                        <section>
                            <div class="alert alert-info">
                                <p>هیچ محصولی برای نمایش وجود ندارد</p>
                            </div>
                        </section>
                    @endforelse
                </section>
            </section>
        </section>
    </section>
    {{-- end product lazy load --}}


    {{-- Ads: two-column --}}
    <section class="max-w-screen-xl mx-auto px-4 mb-6">
        <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse(($homePage['banners']['2'] ?? []) as $banner)
                <a href="{{ urldecode($banner->link) }}" class="block rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <img class="w-full" src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                </a>
            @empty
                <section class="col-span-2 flex items-center justify-center h-40 bg-gray-100 rounded-2xl text-gray-400 text-sm">
                    هیچ عکسی وجود ندارد
                </section>
            @endforelse
        </section>
    </section>
    {{-- end ads section --}}


    {{-- Offer products --}}
    <section class="max-w-screen-xl mx-auto px-4 mb-6">
        <section class="bg-white rounded-2xl shadow-sm p-5 md:p-6">
            <section class="flex justify-between items-center mb-5">
                <h2 class="flex items-center gap-2 text-lg font-bold text-gray-900">
                    <span class="w-1.5 h-5 rounded-full bg-amber-500 inline-block"></span>
                    پیشنهاد {{ config('app.app_persian_name') }} به شما
                </h2>
                <a href="{{ route('products.products', ['sort' => '5']) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-1">
                    مشاهده همه <i class="fa fa-angle-left text-xs"></i>
                </a>
            </section>

            <section class="lazyload-wrapper">
                <section class="lazyload light-owl-nav owl-carousel owl-theme">
                    @foreach($homePage['getOfferProducts'] as $offerProduct)
                        <section class="item">
                            <section class="lazyload-item-wrapper">
                                <section class="group relative border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow bg-white">

                                    <a href="#"
                                       class="absolute top-3 left-3 z-10 w-8 h-8 rounded-full bg-white/90 shadow flex items-center justify-center text-gray-600 hover:text-indigo-600 transition-colors"
                                       data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید">
                                        <i class="fa fa-cart-plus text-sm"></i>
                                    </a>

                                    @php $isOfferFavorite = auth()->check() && $offerProduct->user->contains(auth()->id()); @endphp
                                    <section class="absolute top-3 right-3 z-10">
                                        <button
                                            type="button"
                                            class="favorite-btn w-8 h-8 rounded-full bg-white/90 shadow flex items-center justify-center transition-colors"
                                            data-url="{{ route('customer.market.product.favorite', $offerProduct) }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="left"
                                            title="{{ $isOfferFavorite ? 'حذف از علاقه مندی' : 'افزودن به علاقه مندی' }}">
                                            <i class="fa fa-heart text-sm {{ $isOfferFavorite ? 'text-rose-500' : 'text-gray-400' }}"></i>
                                        </button>
                                    </section>

                                    <a class="block" href="{{ route('customer.market.product', $offerProduct->slug) }}">
                                        <section class="bg-gray-50 p-6 flex items-center justify-center h-40">
                                            <img class="max-h-full object-contain" src="{{ asset($offerProduct->image['indexArray']['medium']) }}" alt="{{ $offerProduct->name }}">
                                        </section>

                                        <section class="p-3">
                                            <h3 class="text-sm text-gray-800 font-medium mb-2 truncate">{{ Str::limit($offerProduct->name, 21) }}</h3>

                                            @if($offerProduct->activeAmazingSales())
                                                <section class="flex items-center gap-2 mb-1">
                                                    <span class="text-xs text-gray-400 line-through">{{ priceFormat($offerProduct->price) }}</span>
                                                    <span class="text-xs text-rose-600 bg-rose-50 px-1.5 py-0.5 rounded-full">{{ priceFormat($offerProduct->activeAmazingSales()->percentage) }} %</span>
                                                </section>
                                                <section class="text-sm font-bold text-gray-900">{{ priceFormat($offerProduct->price - $offerProduct->price * ($offerProduct->activeAmazingSales()->percentage / 100)) }} تومان</section>
                                            @else
                                                <section class="text-sm font-bold text-gray-900">{{ priceFormat($offerProduct->price)}} تومان</section>
                                            @endif

                                            <section class="flex items-center gap-1 mt-2">
                                                @foreach($offerProduct->colors()->get() as $color)
                                                    <span class="w-3.5 h-3.5 rounded-full border border-gray-200" style="background-color: {{ $color->color }};"></span>
                                                @endforeach
                                            </section>
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
    {{-- end product lazy load --}}


    @if($homePage['banners']['3'] ?? [])
        {{-- Ads: one-column --}}
        <section class="max-w-screen-xl mx-auto px-4 mb-6">
            <section class="grid grid-cols-4 gap-4">
                @forelse(($homePage['banners']['3'] ?? []) as $banner)
                    <a href="{{ urldecode($banner->link) }}" class="block rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <img class="w-full" src="{{ asset($banner->image) }}" alt="{{ $banner->name }}">
                    </a>
                @empty
                    <section class="flex items-center justify-center h-40 bg-gray-100 rounded-2xl text-gray-400 text-sm">
                        هیچ عکسی وجود ندارد
                    </section>
                @endforelse
            </section>
        </section>
        {{-- end ads section --}}
    @endif


    {{-- Featured Brands --}}
    <section class="max-w-7xl mx-auto px-4 my-10">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-2 h-8 rounded-full bg-blue-600"></div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        برندهای ویژه
                    </h2>
                    <p class="text-sm text-gray-500">
                        محبوب‌ترین برندهای فروشگاه
                    </p>
                </div>
            </div>
            <i class="fa-solid fa-award text-4xl text-amber-400 hidden md:block"></i>
        </div>

        <section class="brands owl-carousel owl-theme">
            @foreach($homePage['brands'] as $brand)
                <div class="item py-2">
                    <a href="{{ route('products.products', ['search' => '', 'brand' => [$brand->id], 'min_price' => '', 'max_price' => '']) }}" class="group block">
                        <div
                            class="bg-white rounded-2xl h-32 flex items-center justify-center border border-gray-200 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-blue-500">
                            <img src="{{ asset($brand->image['indexArray']['medium']) }}" alt="{{ $brand->persian_name }}" class="h-16 w-36 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                        </div>
                    </a>
                </div>
            @endforeach
        </section>
    </section>

    @include('customer.notifications.toast')

@endsection

@section('script')
    <script src="{{ asset('customer-assets/js/addToFavorite.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('customer-assets/js/home.js') }}" crossorigin="anonymous"></script>
@endsection
