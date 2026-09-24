<header class="header mb-4">

    {{-- Top header: logo, search box, user menu, cart --}}
    <section class="top-header">
        <section class="container-xxl">
            <section class="d-md-flex justify-content-md-between align-items-md-center py-3">

                @include('customer.layouts.header.logo')

                {{-- Search box --}}
                @include('customer.layouts.header.search-box')

                {{-- User menu + cart --}}
                <section class="mt-3 mt-md-auto text-end">

                    {{-- User account --}}
                    @include('customer.layouts.header.account-box')
                    {{-- Cart --}}
                    <section class="header-cart position-relative d-inline-block">
                        <a
                            href="{{ auth()->check() ? 'javascript:void(0)' : route('auth.customer.login-register-form') }}"
                            class="header-cart-link position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            @auth
                                @if($cartItems->count())
                                    <span class="badge rounded-pill bg-danger">
                                        {{ $cartItems->count() }}
                                    </span>
                                @endif
                            @endauth

                        </a>
                        @include('customer.layouts.header.cart-dropdown')
                    </section>

                </section>
            </section>
        </section>
    </section>


    <!-- start menu -->
    <nav class="top-nav">
        <section class="container-xxl ">
            <nav class="">
                <section class="d-none d-md-flex justify-content-md-start position-relative">

                    <section class="super-navbar-item me-4">
                        <section class="super-navbar-item-toggle">
                            <i class="fa fa-bars me-1"></i>
                            دسته بندی کالاها
                        </section>
                        <section class="sublist-wrapper position-absolute w-100">
                            @include('customer.layouts.header.categories-menu', ['categories' => $categories])
                        </section>
                    </section>
                    <section class="border-start my-2 mx-1"></section>
                    <section class="navbar-item"><a href="#">سوپرمارکت</a></section>
                    <section class="navbar-item"><a href="#">تخفیف ها و پیشنهادها</a></section>
                    <section class="navbar-item"><a href="#">آمازون من</a></section>
                    <section class="navbar-item"><a href="#">آمازون پلاس</a></section>
                    <section class="navbar-item"><a href="#">درباره ما</a></section>
                    <section class="navbar-item"><a href="#">فروشنده شوید</a></section>
                    <section class="navbar-item"><a href="#">فرصت های شغلی</a></section>
                </section>
            </nav>
        </section>
    </nav>
    <!-- end menu -->
</header>
<!-- end header -->
