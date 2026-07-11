@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>لیست علاقه مندی ها</title>
@endsection

@section('content')

    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @include('customer.layouts.aside')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>لیست علاقه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->

                        @forelse(auth()->user()->favoriteProducts as $favorites)
                        <section class="cart-item d-flex py-3">
                            <section class="cart-img align-self-start flex-shrink-1"><img src="{{ asset($favorites->image['indexArray']['medium']) }}" alt=""></section>
                            <section class="align-self-end w-100">
                                <section>
                                    <a href="#" class="text-decoration-none cart-delete" data-url="{{ route('customer.profile.favorite-delete', $favorites) }}">
                                        <i class="fa fa-trash-alt"></i>
                                        حذف از لیست علاقه‌ها
                                    </a>
                                </section>
                            </section>
                            <section class="align-self-end flex-shrink-1">
                                <section class="text-nowrap fw-bold">{{ priceFormat($favorites->price) }} تومان</section>
                            </section>
                        </section>
                        @empty
                            <section class="order-item">
                                <p class="text-center text-black">محصولی یافت نشد.</p>
                            </section>
                        @endforelse

                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->

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
