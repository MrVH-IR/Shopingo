@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>لیست علاقه مندی ها</title>
@endsection

@section('content')
    <section class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-4">

            @include('customer.layouts.aside')

            <main class="w-full md:w-3/4">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">

                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-heart text-orange-500"></i>
                            لیست علاقه‌های من
                        </h2>
                    </div>

                    <div class="flex flex-col gap-3">
                        @forelse(auth()->user()->favoriteProducts as $favorites)
                            <div class="flex flex-col sm:flex-row items-center gap-4 border border-gray-100 rounded-xl p-4 hover:shadow-md transition-shadow duration-200">

                                <img src="{{ asset($favorites->image['indexArray']['medium']) }}"
                                     alt=""
                                     class="w-20 h-20 rounded-lg object-cover flex-shrink-0 bg-gray-50">

                                <div class="flex-1 w-full text-center sm:text-right">
                                    <button type="button"
                                            class="cart-delete inline-flex items-center gap-2 text-red-500 hover:text-red-600 text-sm font-medium transition-colors duration-200"
                                            data-url="{{ route('customer.profile.favorite-delete', $favorites) }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                        حذف از لیست علاقه‌ها
                                    </button>
                                </div>

                                <div class="flex-shrink-0 text-nowrap font-bold text-gray-700">
                                    {{ priceFormat($favorites->price) }} تومان
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400">
                                <i class="fa-solid fa-heart-crack text-3xl mb-3"></i>
                                <p>محصولی یافت نشد.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </main>
        </div>
    </section>

    <form id="delete_form" method="POST">@csrf @method('DELETE')</form>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.cart-delete').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.getElementById('delete_form');
                form.action = this.dataset.url;
                form.submit();
            });
        });
    </script>
@endsection
