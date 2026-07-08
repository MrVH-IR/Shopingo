@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>صفحه پرداخت</title>
    <link rel="stylesheet" href="{{ asset('customer-assets/css/payment.css') }}">
@endsection
@section('content')
<section class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                <i class="fa-solid fa-credit-card text-blue-600 text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800">
                    انتخاب روش پرداخت
                </h1>
                <p class="text-gray-500 mt-1">
                    در آخرین مرحله، کد تخفیف و نحوه پرداخت سفارش خود را انتخاب کنید.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- RIGHT -->
        <div class="lg:col-span-8 space-y-6">

            @include('customer.payment.discount-card')

            @include('customer.payment.payment-method')

        </div>
        <!-- LEFT -->
        <div class="lg:col-span-4">
            @include('customer.payment.cart-summary')
        </div>
    </div>
</section>
@endsection
@section('script')
    <script src="{{ asset('customer-assets/js/payment.js') }}" crossorigin="anonymous"></script>
@endsection
