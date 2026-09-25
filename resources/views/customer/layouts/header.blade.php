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
        <section class="container-xxl">
            <section class="main-navigation">
                {{-- Categories --}}
                <section class="categories-menu">
                    <button type="button" class="categories-menu-trigger">
                        <i class="fas fa-bars"></i>
                        <span>دسته‌بندی کالاها</span>
                        <i class="fas fa-chevron-down categories-menu-arrow"></i>
                    </button>
                    <section class="categories-mega-menu">

                        {{-- Main categories --}}
                        <section class="categories-sidebar">
                            @foreach($categories as $category)
                                <a href="{{ route('products.products', $category->id) }}" class="category-sidebar-item {{ $loop->first ? 'active' : '' }}"
                                    data-category-id="{{ $category->id }}">
                                    <span>{{ $category->name }}</span>
                                    @if($category->children->isNotEmpty())
                                        <i class="fas fa-chevron-left"></i>
                                    @endif
                                </a>
                            @endforeach
                        </section>

                        {{-- Category content --}}
                        <section class="categories-content">
                            @foreach($categories as $category)
                                <section
                                    class="category-panel {{ $loop->first ? 'active' : '' }}"
                                    data-category-panel="{{ $category->id }}">
                                    <section class="category-panel-header">
                                        <div>
                                        <span class="category-panel-title">
                                            {{ $category->name }}
                                        </span>
                                            @if($category->children->isNotEmpty())
                                                <span class="category-panel-count">
                                                {{ $category->children->count() }} دسته
                                            </span>
                                            @endif
                                        </div>
                                        <a href="{{ route('products.products', $category->id) }}" class="view-all-categories">
                                            مشاهده همه
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                    </section>
                                    @if($category->children->isNotEmpty())
                                        <section class="category-columns">
                                            @foreach($category->children as $child)
                                                <section class="category-column">
                                                    <a href="{{ route('products.products', $child->id) }}" class="category-column-title">
                                                        {{ $child->name }}
                                                        @if($child->children->isNotEmpty())
                                                            <i class="fas fa-chevron-left"></i>
                                                        @endif
                                                    </a>
                                                    @if($child->children->isNotEmpty())
                                                        <section class="category-column-items">
                                                            @foreach($child->children as $grandChild)
                                                                <a
                                                                    href="{{ route('products.products', $grandChild->id) }}"
                                                                    class="category-column-item"
                                                                >
                                                                    {{ $grandChild->name }}
                                                                </a>
                                                            @endforeach
                                                        </section>
                                                    @endif
                                                </section>
                                            @endforeach
                                        </section>
                                    @else
                                        <section class="category-empty">
                                            دسته‌بندی دیگری برای این بخش وجود ندارد.
                                        </section>
                                    @endif
                                </section>
                            @endforeach
                        </section>
                    </section>
                </section>
                {{-- Navigation links --}}
                <section class="navigation-links">
                    <a href="#" class="navigation-link">
                        <i class="fas fa-store"></i>
                        <span>سوپرمارکت</span>
                    </a>
                    <a href="#" class="navigation-link navigation-link-sale">
                        <i class="fas fa-percent"></i>
                        <span>تخفیف‌ها و پیشنهادها</span>
                        <span class="navigation-link-badge">ویژه</span>
                    </a>
                    <a href="#" class="navigation-link">
                        <i class="fas fa-user"></i>
                        <span>{{ config('app.app_persian_name') }} من</span>
                    </a>
                    <a href="#" class="navigation-link">
                        <i class="fas fa-crown"></i>
                        <span>{{ config('app.app_persian_name') }} پلاس</span>
                    </a>
                    <a href="{{ route('about-us') }}" class="navigation-link">
                        <i class="fas fa-circle-info"></i>
                        <span>درباره ما</span>
                    </a>
                    <a href="#" class="navigation-link">
                        <i class="fas fa-store"></i>
                        <span>فروشنده شوید</span>
                    </a>
                    <a href="#" class="navigation-link">
                        <i class="fas fa-briefcase"></i>
                        <span>فرصت‌های شغلی</span>
                    </a>
                </section>
            </section>
        </section>
    </nav>
    <!-- end menu -->
</header>
<!-- end header -->
