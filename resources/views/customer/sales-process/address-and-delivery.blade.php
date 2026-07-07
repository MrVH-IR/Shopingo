@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>مدیریت آدرس ها</title>
    <link rel="stylesheet" href="{{ asset('customer-assets/css/address-and-delivery.css') }}"></link>
@endsection

@section('content')
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">

                    <!-- هدر صفحه -->
                    <section class="mb-4">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-truck-fast text-blue-600"></i>
                            تکمیل اطلاعات ارسال کالا
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">آدرس گیرنده، مشخصات گیرنده و نحوه‌ی ارسال را مشخص کنید</p>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">

                            <!-- ============ بخش انتخاب آدرس ============ -->
                            <section class="bg-white p-4 md:p-5 rounded-2xl shadow-sm mb-4">

                                <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <i class="fas fa-location-dot text-blue-600"></i>
                                    انتخاب آدرس و مشخصات گیرنده
                                </h3>

                                <div class="flex items-start gap-2 bg-blue-50 text-blue-800 text-sm rounded-xl p-3 mb-4 border border-blue-100">
                                    <i class="fa fa-info-circle mt-0.5"></i>
                                    <span>پس از ایجاد آدرس، آدرس را انتخاب کنید.</span>
                                </div>

                                @if($errors->any())
                                    <div class="mb-4 space-y-2">
                                        @foreach($errors->all() as $error)
                                            <div class="flex items-center gap-2 bg-red-50 text-red-700 text-sm rounded-xl p-3 border border-red-100">
                                                <i class="fa fa-circle-exclamation"></i>
                                                <span>{{ $error }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                                    @foreach(auth()->user()->addresses as $address)

                                        <input
                                            type="radio"
                                            name="address"
                                            id="address-{{ $address->id }}"
                                            value="{{ $address->id }}"
                                            form="checkout-form"
                                            class="address-radio"
                                        >

                                        <label
                                            for="address-{{ $address->id }}"
                                            class="address-card">

                                        <span class="check-icon">
                                            <i class="fa fa-check"></i>
                                        </span>

                                            <div class="mb-2">
                                                <strong>آدرس:</strong>
                                                {{ $address->address }}
                                            </div>

                                            <div class="mb-2">
                                                <strong>گیرنده:</strong>
                                                {{ $address->fullName }}
                                            </div>

                                            <div>
                                                <strong>موبایل:</strong>
                                                {{ $address->mobile }}
                                            </div>

                                        </label>

                                    @endforeach
                                </div>

                                <!-- دکمه ایجاد آدرس جدید -->
                                <button type="button"
                                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-6 rounded-xl shadow-md hover:shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 flex items-center justify-center gap-2"
                                        data-bs-toggle="modal" data-bs-target="#add-address">
                                    <i class="fas fa-plus-circle"></i> ایجاد آدرس جدید
                                </button>

                                @include('customer.sales-process.add-address-modal')
                            </section>

                            <!-- ============ بخش انتخاب نحوه ارسال ============ -->
                            <section class="bg-white p-4 md:p-5 rounded-2xl shadow-sm mb-4">

                                <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <i class="fas fa-truck text-blue-600"></i>
                                    انتخاب نحوه ارسال
                                </h3>

                                <div class="flex items-start gap-2 bg-blue-50 text-blue-800 text-sm rounded-xl p-3 mb-4 border border-blue-100">
                                    <i class="fa fa-info-circle mt-0.5"></i>
                                    <span>نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفاً مدت زمان ارسال را در نظر بگیرید.</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3" id="delivery-options">
                                    @foreach($deliveries as $delivery)

                                        <input
                                            type="radio"
                                            name="delivery_type"
                                            id="delivery-{{ $delivery->id }}"
                                            value="{{ $delivery->id }}"
                                            data-amount="{{ $delivery->amount }}"
                                            form="checkout-form"
                                            class="delivery-radio"
                                        >

                                        <label
                                            for="delivery-{{ $delivery->id }}"
                                            class="delivery-card">

                                            <span class="check-icon">
                                                <i class="fa fa-check"></i>
                                            </span>

                                            <div class="fw-bold">
                                                {{ $delivery->name }}
                                            </div>

                                            <div class="text-muted small">
                                                {{ $delivery->delivery_time }} روز کاری
                                            </div>

                                            <div class="fw-bold text-primary">
                                                {{ number_format($delivery->amount) }} تومان
                                            </div>

                                        </label>

                                    @endforeach
                                </div>
                            </section>

                        </section>

                        <!-- ============ خلاصه سفارش / مبلغ نهایی ============ -->
                            @include('customer.sales-process.cart-modal')
                    </section>

                </section>
            </section>
        </section>
    </section>

    @include('customer.sales-process.edit-adress-and-delivery')
@endsection

@section('script')
    <script src="{{ asset('customer-assets/js/address-and-delivery.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            function format(number){
                return new Intl.NumberFormat('fa-IR').format(number) + " تومان";
            }

            function updateSummary(){

                const subtotal =
                    Number(document.getElementById("subtotal-amount").dataset.amount);

                const delivery =
                    document.querySelector("input[name='delivery_type']:checked");

                const shipping =
                    delivery ? Number(delivery.dataset.amount) : 0;

                document.getElementById("shipping-amount").textContent =
                    format(shipping);

                document.getElementById("final-amount").textContent =
                    format(subtotal + shipping);

            }

            document
                .querySelectorAll("input[name='delivery_type']")
                .forEach(radio=>{
                    radio.addEventListener("change",updateSummary);
                });

            updateSummary();

        });
    </script>
@endsection
