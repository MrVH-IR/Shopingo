<div
    class="relative hidden flex-1 md:block"
    x-data="{
        open: false,
        loading: false,
        keyword: @js(request('search', '')),
        results: [],
        history: JSON.parse(localStorage.getItem('search_history') || '[]'),
        timer: null,

        saveSearch() {
            const value = this.keyword.trim();

            if (!value) {
                return;
            }

            this.history = this.history.filter((item) => item !== value);
            this.history.unshift(value);
            this.history = this.history.slice(0, 6);
            localStorage.setItem('search_history', JSON.stringify(this.history));
        },

        submitSearch() {
            const value = this.keyword.trim();

            if (!value) {
                return;
            }

            this.saveSearch();
            window.location.href = `{{ route('products.products') }}?search=${encodeURIComponent(value)}`;
        },

        choose(value) {
            this.keyword = value;
            this.open = false;
            const term = String(value || '').trim();

            if (!term) {
                return;
            }

            this.saveSearch();
            window.location.href = `{{ route('products.products') }}?search=${encodeURIComponent(term)}`;
        },

        clearHistory() {
            this.history = [];
            localStorage.removeItem('search_history');
        },

        fetchResults() {
            const term = this.keyword.trim();

            clearTimeout(this.timer);

            if (term.length < 2) {
                this.results = [];
                this.loading = false;
                return;
            }

            this.loading = true;

            this.timer = setTimeout(async () => {
                try {
                    const response = await fetch(`{{ route('products.search') }}?search=${encodeURIComponent(term)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    this.results = await response.json();
                } catch (error) {
                    this.results = [];
                } finally {
                    this.loading = false;
                }
            }, 250);
        },
    }"
    @click.outside="open = false"
>
    <form
        x-ref="form"
        method="GET"
        action="{{ route('products.products') }}"
        class="relative"
        @submit.prevent="submitSearch()"
    >
        <label for="search" class="sr-only">Search products</label>

        <i class="fas fa-search pointer-events-none absolute right-4 top-1/2 z-10 -translate-y-1/2 text-gray-400"></i>

        <input
            x-ref="input"
            id="search"
            name="search"
            type="search"
            x-model="keyword"
            autocomplete="off"
            placeholder="جستجوی کالا، برند، دسته بندی ..."
            class="mt-3 h-12 w-full rounded-2xl border border-gray-200 bg-white pr-12 pl-4 text-sm text-gray-700 shadow-sm outline-none transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            @focus="open = true; fetchResults()"
            @input="open = true; fetchResults()"
            @keydown.enter.prevent="submitSearch()"
        >

        <section
            x-show="open"
            x-transition.origin.top
            x-cloak
            class="absolute left-0 right-0 top-full z-50 mt-3 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-2xl"
        >
            <div class="border-b border-gray-100 px-4 py-3">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">Live search</p>

                    <button
                        type="button"
                        @click="clearHistory()"
                        x-show="history.length"
                        class="text-xs font-medium text-red-500 transition hover:text-red-700"
                    >
                        پاک کردن تاریخچه
                    </button>
                </div>
            </div>

            <div class="max-h-[420px] overflow-y-auto p-4">
                <template x-if="loading">
                    <div class="flex items-center gap-3 rounded-2xl bg-gray-50 px-4 py-3 text-sm text-gray-500">
                        <i class="fas fa-spinner fa-spin text-blue-500"></i>
                        <span>در حال جستجو...</span>
                    </div>
                </template>

                <template x-if="!loading && results.length">
                    <div class="space-y-2">
                        <template x-for="item in results" :key="item.slug">
                            <a
                                :href="item.url"
                                class="flex items-center gap-3 rounded-2xl px-3 py-2.5 transition hover:bg-gray-50"
                            >
                                <div class="h-14 w-14 overflow-hidden rounded-2xl bg-gray-100 ring-1 ring-gray-100">
                                    <template x-if="item.image">
                                        <img :src="item.image" :alt="item.name" class="h-full w-full object-cover">
                                    </template>
                                    <template x-if="!item.image">
                                        <div class="flex h-full w-full items-center justify-center">
                                            <i class="fas fa-box text-gray-300"></i>
                                        </div>
                                    </template>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-semibold text-gray-800" x-text="item.name"></p>
                                    <p class="mt-1 text-xs text-gray-500" x-text="item.slug"></p>
                                </div>

                                <div class="shrink-0 text-left">
                                    <p class="text-sm font-bold text-blue-600" x-text="new Intl.NumberFormat('fa-IR').format(item.price)"></p>
                                </div>
                            </a>
                        </template>
                    </div>
                </template>

                <template x-if="!loading && keyword.trim().length >= 2 && !results.length">
                    <div class="rounded-2xl bg-gray-50 px-4 py-5 text-center text-sm text-gray-500">
                        نتیجه‌ای برای این عبارت پیدا نشد.
                    </div>
                </template>

                <template x-if="!loading && keyword.trim().length < 2">
                    <div class="space-y-6">
                        <div>
                            <h6 class="mb-3 text-sm font-bold text-gray-700">جستجوهای پیشنهادی</h6>
                            <div class="grid grid-cols-1 gap-2">
                                @foreach ([
                                    ['name' => 'آیفون', 'icon' => 'fa-solid fa-mobile-screen-button', 'tone' => 'bg-rose-50 text-rose-600'],
                                    ['name' => 'لپ تاپ', 'icon' => 'fa-solid fa-laptop', 'tone' => 'bg-sky-50 text-sky-600'],
                                    ['name' => 'هدفون', 'icon' => 'fa-solid fa-headphones-simple', 'tone' => 'bg-emerald-50 text-emerald-600'],
                                ] as $item)
                                    <button
                                        type="button"
                                        @click="choose(@js($item['name']))"
                                        class="flex items-center gap-3 rounded-2xl px-3 py-3 text-right transition hover:bg-gray-50"
                                    >
                                        <span class="flex h-9 w-9 items-center justify-center rounded-xl {{ $item['tone'] }}">
                                            <i class="{{ $item['icon'] }}"></i>
                                        </span>
                                        <span class="flex-1 text-sm font-medium text-gray-700">{{ $item['name'] }}</span>
                                        <i class="fas fa-arrow-left text-xs text-gray-300"></i>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <div class="mb-3 flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-700">آخرین جستجوها</span>
                                <button
                                    x-show="history.length"
                                    type="button"
                                    @click="clearHistory()"
                                    class="text-xs font-medium text-red-500 transition hover:text-red-700"
                                >
                                    پاک کردن
                                </button>
                            </div>

                            <template x-if="history.length === 0">
                                <p class="rounded-2xl bg-gray-50 px-4 py-4 text-center text-sm text-gray-400">
                                    هنوز جستجویی انجام نشده است.
                                </p>
                            </template>

                            <template x-for="item in history" :key="item">
                                <button
                                    type="button"
                                    @click="choose(item)"
                                    class="mb-2 flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-right transition hover:bg-gray-50"
                                >
                                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-gray-100 text-gray-500">
                                        <i class="fas fa-clock-rotate-left"></i>
                                    </span>
                                    <span class="flex-1 text-sm font-medium text-gray-700" x-text="item"></span>
                                    <i class="fas fa-arrow-left text-xs text-gray-300"></i>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </form>
</div>
