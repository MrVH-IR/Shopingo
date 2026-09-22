@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>لیست مقایسه‌های من {{ config('app.app_persian_name') }}</title>
@endsection

@section('content')
    <section class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-4">

            @include('customer.layouts.aside')

            <main class="w-full md:w-3/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa fa-exchange text-orange-500"></i>
                            لیست مقایسه‌های من
                        </h2>

                        @if($products->count())
                            <span class="text-sm text-gray-400">
                                {{ $products->count() }} محصول
                            </span>
                        @endif
                    </div>

                    <div class="flex flex-col gap-3">
                        @forelse($products as $product)
                            <div class="flex flex-col sm:flex-row items-center gap-4 border border-gray-100 rounded-xl p-4 hover:shadow-md transition-shadow duration-200">

                                {{-- Product Image --}}
                                <img src="{{ asset($product->image['indexArray']['medium']) }}"
                                     alt="{{ $product->name }}"
                                     class="w-20 h-20 rounded-lg object-cover flex-shrink-0 bg-gray-50">

                                {{-- Product Info --}}
                                <div class="flex-1 w-full text-center sm:text-right">
                                    <a href="{{ route('customer.market.product', $product->slug) }}"
                                       class="block font-semibold text-gray-800 hover:text-orange-500 transition-colors duration-200">
                                        {{ $product->name }}
                                    </a>

                                    @if($product->brand)
                                        <span class="block mt-1 text-sm text-blue-400">
                                            برند: {{ $product->brand->persian_name }}
                                        </span>
                                    @endif
                                    @if($product->metas)
                                        @foreach($product->metas as $meta)
                                            <span class="block mt-1 text-sm text-red-400">
                                            مشخصات: {{ $meta->meta_key }}
                                            </span>
                                            <span class="block mt-1 text-sm text-red-400">
                                            مقدار: {{ $meta->meta_value }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>

                                {{-- Price --}}
                                <div class="flex-shrink-0 text-nowrap font-bold text-gray-700">
                                    {{ priceFormat($product->price) }} تومان
                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <a href="{{ route('customer.market.product', $product->slug) }}"
                                       class="inline-flex items-center gap-2 rounded-lg bg-orange-50 px-3 py-2 text-sm font-medium text-orange-600 hover:bg-orange-100 transition-colors duration-200">
                                        <i class="fa fa-eye"></i>
                                        مشاهده
                                    </a>

                                    <button type="button"
                                            class="compare-delete inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors duration-200"
                                            data-url="{{ route('customer.market.product.compare', $product->slug) }}"
                                            data-bs-toggle="tooltip"
                                            title="حذف از مقایسه">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>

                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400">
                                <i class="fa fa-exchange text-3xl mb-3"></i>
                                <p>محصولی در لیست مقایسه وجود ندارد.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Compare --}}
                    @if($products->count() >= 2)
                        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                            <a href="{{ route('customer.profile.my-compares') }}"
                               class="inline-flex items-center gap-2 rounded-xl bg-orange-500 px-5 py-3 text-sm font-semibold text-white hover:bg-orange-600 transition-colors duration-200">
                                <i class="fa fa-exchange"></i>
                                مقایسه محصولات
                            </a>
                        </div>
                    @endif

                </div>
            </main>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.compare-delete').forEach(button => {
            button.addEventListener('click', async function (e) {
                e.preventDefault();

                if (this.disabled) return;

                this.disabled = true;

                try {
                    const response = await fetch(this.dataset.url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    });

                    if (response.status === 401) {
                        window.location.href = '{{ route('login') }}';
                        return;
                    }

                    const data = await response.json();

                    if (data?.success && data.action === 'removed') {
                        this.closest('.border').remove();

                        if (!document.querySelector('.compare-delete')) {
                            window.location.reload();
                        }
                    }
                } catch (error) {
                    console.error('Compare delete error:', error);
                } finally {
                    this.disabled = false;
                }
            });
        });
    </script>
@endsection
