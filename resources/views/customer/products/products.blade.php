@extends('customer.layouts.master-one-col')

@section('head-tag')
    <title>{{ config('app.app_persian_name') }}</title>
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50 py-6" dir="rtl">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Mobile Filter Button --}}
            <div class="mb-4 lg:hidden" x-data>
                <button
                    type="button"
                    @click="$dispatch('open-filters')"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-slate-800"
                >
                    <i class="fa fa-filter text-xs"></i>
                    فیلتر محصولات
                </button>
            </div>

            <div
                x-data="{ filtersOpen: false }"
                @open-filters.window="filtersOpen = true"
            >

                {{-- Mobile Filter Overlay --}}
                <div
                    x-show="filtersOpen"
                    x-cloak
                    class="fixed inset-0 z-40 bg-black/40 lg:hidden"
                    @click="filtersOpen = false"
                ></div>

                <div class="grid grid-cols-1 gap-5 lg:grid-cols-12">

                    {{-- ================= SIDEBAR ================= --}}
                    <aside
                        class="fixed inset-y-0 right-0 z-50 w-[85%] max-w-sm overflow-y-auto bg-slate-50 p-4 shadow-2xl transition-transform duration-300 lg:static lg:z-auto lg:col-span-3 lg:w-auto lg:max-w-none lg:translate-x-0 lg:overflow-visible lg:bg-transparent lg:p-0 lg:shadow-none"
                        :class="filtersOpen ? 'translate-x-0' : 'translate-x-full'"
                    >

                        {{-- Mobile Sidebar Header --}}
                        <div class="mb-4 flex items-center justify-between lg:hidden">
                            <div>
                                <h2 class="text-base font-bold text-slate-800">
                                    فیلتر محصولات
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    محصولات موردنظر خود را پیدا کنید
                                </p>
                            </div>

                            <button
                                type="button"
                                @click="filtersOpen = false"
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm transition hover:text-slate-900"
                            >
                                <i class="fa fa-times"></i>
                            </button>
                        </div>

                        {{-- ================= FILTER FORM ================= --}}
                        <form
                            action="{{ route('products.products') }}"
                            method="GET"
                            class="space-y-4"
                        >

                            {{-- ================= CATEGORIES ================= --}}
                            <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                                <div class="mb-4 flex items-center gap-3 border-b border-slate-100 pb-4">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                                        <i class="fa fa-th-large text-sm"></i>
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-bold text-slate-800">
                                            دسته‌بندی محصولات
                                        </h3>

                                        <p class="mt-1 text-[11px] text-slate-400">
                                            انتخاب دسته‌بندی
                                        </p>
                                    </div>

                                </div>

                                @include('customer.layouts.partial.categories', [
                                    'categories' => $categories
                                ])

                            </section>


                            {{-- ================= SEARCH ================= --}}
                            <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                                <div class="mb-3 flex items-center gap-2">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                        <i class="fa fa-search text-xs"></i>
                                    </div>

                                    <h3 class="text-sm font-bold text-slate-800">
                                        جستجو در نتایج
                                    </h3>

                                </div>

                                <div class="relative">

                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="نام محصول، برند ..."
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                                    >

                                </div>

                            </section>


                            {{-- ================= BRANDS ================= --}}
                            <section
                                class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm"
                                x-data="{ open: true, showAll: false }"
                            >

                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="flex w-full items-center justify-between"
                                >

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                            <i class="fa fa-tag text-xs"></i>
                                        </div>

                                        <span class="text-sm font-bold text-slate-800">
                                            برند
                                        </span>

                                        @if(count(request('brand', [])) > 0)
                                            <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-indigo-100 px-1.5 text-[10px] font-bold text-indigo-600">
                                                {{ count(request('brand', [])) }}
                                            </span>
                                        @endif

                                    </div>

                                    <i
                                        class="fa fa-angle-down text-xs text-slate-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''"
                                    ></i>

                                </button>


                                <div
                                    x-show="open"
                                    x-collapse
                                    class="mt-4"
                                >

                                    <div class="space-y-1">

                                        @foreach($brands as $index => $brand)

                                            <label
                                                x-show="showAll || {{ $index }} < 8"
                                                class="flex cursor-pointer items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-slate-50"
                                            >

                                                <input
                                                    type="checkbox"
                                                    name="brand[]"
                                                    value="{{ $brand->id }}"
                                                    @checked(in_array($brand->id, request('brand', [])))
                                                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                                >

                                                <span class="flex min-w-0 flex-1 flex-col">
                                                    <span class="truncate text-sm font-medium text-slate-700">
                                                        {{ $brand->persian_name }}
                                                    </span>

                                                    @if($brand->original_name)
                                                        <span class="truncate text-[10px] text-slate-400">
                                                            {{ $brand->original_name }}
                                                        </span>
                                                    @endif
                                                </span>

                                            </label>

                                        @endforeach

                                    </div>

                                    @if($brands->count() > 8)
                                        <button
                                            type="button"
                                            @click="showAll = !showAll"
                                            class="mt-3 flex w-full items-center justify-center gap-1 rounded-xl bg-slate-50 py-2 text-xs font-semibold text-indigo-600 transition hover:bg-indigo-50"
                                        >
                                            <span x-text="showAll ? 'نمایش کمتر' : 'نمایش همه برندها'"></span>
                                            <i
                                                class="fa fa-angle-down text-[10px] transition-transform duration-200"
                                                :class="showAll ? 'rotate-180' : ''"
                                            ></i>
                                        </button>
                                    @endif

                                </div>

                            </section>


                            {{-- ================= PRICE ================= --}}
                            <section
                                class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm"
                                x-data="{ open: true }"
                            >

                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="flex w-full items-center justify-between"
                                >

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                            <i class="fa fa-money text-xs"></i>
                                        </div>

                                        <span class="text-sm font-bold text-slate-800">
                                            محدوده قیمت
                                        </span>

                                    </div>

                                    <i
                                        class="fa fa-angle-down text-xs text-slate-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''"
                                    ></i>

                                </button>


                                <div
                                    x-show="open"
                                    x-collapse
                                    class="mt-4"
                                >

                                    <div class="grid grid-cols-2 gap-2">

                                        <div>
                                            <label class="mb-1.5 block text-[11px] text-slate-400">
                                                حداقل
                                            </label>

                                            <input
                                                type="text"
                                                name="min_price"
                                                value="{{ request('min_price') }}"
                                                placeholder="از ..."
                                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                                            >
                                        </div>

                                        <div>
                                            <label class="mb-1.5 block text-[11px] text-slate-400">
                                                حداکثر
                                            </label>

                                            <input
                                                type="text"
                                                name="max_price"
                                                value="{{ request('max_price') }}"
                                                placeholder="تا ..."
                                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                                            >
                                        </div>

                                    </div>

                                </div>

                            </section>


                            {{-- ================= APPLY FILTER ================= --}}
                            <button
                                type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 active:scale-[0.98]"
                            >
                                <i class="fa fa-filter text-xs"></i>
                                اعمال فیلتر
                            </button>

                            @if(request()->query())
                                <a
                                    href="{{ route('products.products') }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-xs font-semibold text-slate-500 transition hover:bg-slate-50 hover:text-slate-800"
                                >
                                    <i class="fa fa-times text-[10px]"></i>
                                    حذف همه فیلترها
                                </a>
                            @endif

                        </form>

                    </aside>


                    {{-- ================= MAIN ================= --}}
                    <main class="min-w-0 lg:col-span-9">

                        <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">

                            {{-- ================= ACTIVE FILTERS ================= --}}
                            @if(request()->query())

                                <div class="mb-5 flex flex-wrap items-center gap-2 border-b border-slate-100 pb-4">

                                    <span class="text-xs font-bold text-slate-500">
                                        فیلترهای فعال:
                                    </span>

                                    @if(request()->filled('search'))
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1.5 text-[11px] font-medium text-indigo-700">
                                            جستجو:
                                            <strong>{{ request('search') }}</strong>
                                        </span>
                                    @endif

                                    @if(request()->filled('brand'))
                                        @foreach($brands->whereIn('id', request('brand', [])) as $brand)
                                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[11px] font-medium text-slate-600">
                                                {{ $brand->persian_name }}
                                            </span>
                                        @endforeach
                                    @endif

                                    @if(request()->filled('category'))
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[11px] font-medium text-slate-600">
                                            دسته:
                                            <strong>{{ request('category') }}</strong>
                                        </span>
                                    @endif

                                    @if(request()->filled('min_price'))
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[11px] font-medium text-slate-600">
                                            از {{ number_format(request('min_price')) }} تومان
                                        </span>
                                    @endif

                                    @if(request()->filled('max_price'))
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[11px] font-medium text-slate-600">
                                            تا {{ number_format(request('max_price')) }} تومان
                                        </span>
                                    @endif

                                </div>

                            @endif


                            {{-- ================= SORT ================= --}}
                            <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                <div class="text-xs font-bold text-slate-500">
                                    مرتب‌سازی بر اساس:
                                </div>

                                <div class="flex flex-wrap gap-1.5">

                                    <a
                                        href="{{ route('products.products', array_merge(request()->query(), ['sort' => 1])) }}"
                                        class="rounded-lg px-3 py-2 text-xs font-semibold transition {{ request()->sort == 1 || !request()->filled('sort') ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700' }}"
                                    >
                                        جدیدترین
                                    </a>

                                    <a
                                        href="{{ route('products.products', array_merge(request()->query(), ['sort' => 2])) }}"
                                        class="rounded-lg px-3 py-2 text-xs font-semibold transition {{ request()->sort == 2 ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700' }}"
                                    >
                                        گران‌ترین
                                    </a>

                                    <a
                                        href="{{ route('products.products', array_merge(request()->query(), ['sort' => 3])) }}"
                                        class="rounded-lg px-3 py-2 text-xs font-semibold transition {{ request()->sort == 3 ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700' }}"
                                    >
                                        ارزان‌ترین
                                    </a>

                                    <a
                                        href="{{ route('products.products', array_merge(request()->query(), ['sort' => 4])) }}"
                                        class="rounded-lg px-3 py-2 text-xs font-semibold transition {{ request()->sort == 4 ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700' }}"
                                    >
                                        پربازدیدترین
                                    </a>

                                    <a
                                        href="{{ route('products.products', array_merge(request()->query(), ['sort' => 5])) }}"
                                        class="rounded-lg px-3 py-2 text-xs font-semibold transition {{ request()->sort == 5 ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700' }}"
                                    >
                                        پرفروش‌ترین
                                    </a>

                                </div>

                            </div>


                            {{-- ================= PRODUCTS ================= --}}
                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">

                                @forelse($products as $product)

                                    <article
                                        x-data="{
                                            favorite: {{ $product->is_favorite ? 'true' : 'false' }},
                                            favoriteLoading: false,
                                            cartLoading: false
                                        }"
                                        class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white transition-all duration-300 hover:-translate-y-1 hover:border-slate-300 hover:shadow-xl hover:shadow-slate-200/60">
                                        @if(auth()->check())
                                            <button
                                                type="button"
                                                @click="
            if (favoriteLoading) return;
            favoriteLoading = true;

            fetch('{{ route('customer.market.product.favorite', $product->slug) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }

                return response.json();
            })
            .then(data => {
                if (data?.success) {
                    favorite = data.action === 'added';
                }
            })
            .finally(() => {
                favoriteLoading = false;
            });
        "
                                                class="absolute right-3 top-3 z-10 flex h-10 w-10 items-center justify-center rounded-full border bg-white shadow-lg transition-all duration-200 hover:scale-105"
                                                :class="favorite ? 'border-red-100 bg-red-50' : 'border-slate-200 bg-white hover:bg-slate-50'"
                                                :disabled="favoriteLoading"
                                                :title="favorite ? 'حذف از علاقه‌مندی‌ها' : 'افزودن به علاقه‌مندی‌ها'"
                                            >
                                                <svg
                                                    class="h-5 w-5 transition-colors duration-200"
                                                    :class="favorite ? 'fill-red-500 text-red-500' : 'fill-none text-slate-700'"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733C11.285 4.876 9.623 3.75 7.688 3.75 5.099 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                </svg>
                                            </button>
                                        @endif

                                            {{-- Add to Cart --}}
                                            @if($product->colors->count() > 0)

                                                <a
                                                    href="{{ route('customer.market.product', $product->slug) }}"
                                                    class="absolute left-3 top-3 z-10 flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-md transition-all duration-200 hover:scale-105 hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
                                                    title="انتخاب رنگ و افزودن به سبد"
                                                >
                                                    <i class="fa fa-shopping-cart text-sm"></i>
                                                </a>

                                            @else

                                                <button
                                                    type="button"
                                                    @click="
                                                    if (cartLoading) return;
                                                    cartLoading = true;

                                                    fetch('{{ route('customer.sales-process.add-to-cart', $product->slug) }}', {
                                                        method: 'POST',
                                                        headers: {
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                            'Accept': 'text/html'
                                                        },
                                                        body: new URLSearchParams({
                                                            number: 1
                                                        })
                                                    })
                                                    .then(response => {
                                                        if (response.redirected) {
                                                            window.location.href = response.url;
                                                            return;
                                                        }

                                                        window.location.reload();
                                                    })
                                                    .catch(() => {
                                                        cartLoading = false;
                                                    });
                                                "
                                                    :class="cartLoading ? 'bg-indigo-50 text-indigo-400 cursor-wait' : 'bg-white text-slate-700 hover:bg-indigo-50 hover:text-indigo-600'"
                                                    class="absolute left-3 top-3 z-10 flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 shadow-md transition-all duration-200 hover:scale-105"
                                                    :disabled="cartLoading"
                                                    title="افزودن به سبد خرید"
                                                >
                                                    <i class="fa fa-shopping-cart text-sm" x-show="!cartLoading"></i>
                                                    <i class="fa fa-spinner fa-spin text-sm" x-show="cartLoading"></i>
                                                </button>

                                            @endif


                                        {{-- Product Link --}}
                                        <a
                                            href="{{ route('customer.market.product', $product->slug) }}"
                                            class="block"
                                        >

                                            {{-- Image --}}
                                            <div class="relative flex aspect-square items-center justify-center overflow-hidden bg-slate-50 p-5">

                                                <img
                                                    src="{{ asset($product->image['indexArray']['medium']) }}"
                                                    alt="{{ $product->name }}"
                                                    loading="lazy"
                                                    class="h-full w-full object-contain transition duration-500 group-hover:scale-105"
                                                >

                                            </div>


                                            {{-- Content --}}
                                            <div class="p-4">

                                                <h3 class="mb-3 line-clamp-2 min-h-[40px] text-sm font-bold leading-5 text-slate-700 transition group-hover:text-indigo-600">
                                                    {{ $product->name }}
                                                </h3>


                                                {{-- Colors --}}
                                                @if($product->colors->count() > 0)

                                                    <div class="mb-4 flex items-center gap-1.5">

                                                        @foreach($product->colors->take(5) as $color)

                                                            <span
                                                                class="h-4 w-4 rounded-full border border-white shadow-sm ring-1 ring-slate-200"
                                                                style="background-color: {{ $color->color }};"
                                                            ></span>

                                                        @endforeach

                                                        @if($product->colors->count() > 5)
                                                            <span class="text-[10px] text-slate-400">
                                                                +{{ $product->colors->count() - 5 }}
                                                            </span>
                                                        @endif

                                                    </div>

                                                @else

                                                    <div class="mb-4 h-4"></div>

                                                @endif


                                                {{-- Price --}}
                                                <div class="flex items-end justify-between gap-2">

                                                    <div>
                                                        <span class="block text-[10px] text-slate-400">
                                                            قیمت
                                                        </span>

                                                        <span class="mt-1 block text-sm font-black text-slate-800">
                                                            {{ priceFormat($product->price) }}
                                                        </span>
                                                    </div>

                                                    <span class="text-[10px] font-medium text-slate-400">
                                                        تومان
                                                    </span>

                                                </div>

                                            </div>

                                        </a>

                                    </article>

                                @empty

                                    <div class="col-span-full flex min-h-[300px] flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-slate-50">

                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-slate-300 shadow-sm">
                                            <i class="fa fa-search text-xl"></i>
                                        </div>

                                        <h3 class="text-sm font-bold text-slate-600">
                                            محصولی پیدا نشد
                                        </h3>

                                        <p class="mt-2 text-xs text-slate-400">
                                            فیلترهای جستجو را تغییر دهید و دوباره امتحان کنید.
                                        </p>

                                    </div>

                                @endforelse

                            </div>


                            {{-- ================= PAGINATION ================= --}}
                            @if($products->hasPages())

                                <div class="mt-8 flex justify-center border-t border-slate-100 pt-6">
                                    {{ $products->links() }}
                                </div>

                            @endif

                        </section>

                    </main>

                </div>

            </div>

        </div>

    </div>

    @include('customer.notifications.toast')

@endsection

@section('script')
@endsection
