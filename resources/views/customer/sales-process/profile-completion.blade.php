@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>تکمیل اطلاعات حساب کاربری</title>
@endsection

@section('content')

    @php
        $user = auth()->user();
        $missingFields = collect([
            ['key' => 'first_name',    'label' => 'نام',            'required' => true],
            ['key' => 'last_name',     'label' => 'نام خانوادگی',    'required' => true],
            ['key' => 'mobile',        'label' => 'موبایل',          'required' => true],
            ['key' => 'national_code', 'label' => 'کد ملی',          'required' => true],
            ['key' => 'email',         'label' => 'ایمیل', 'required' => false],
        ])->filter(fn ($field) => empty($user->{$field['key']}));

        $totalProductPrice = 0;
        $totalDiscount = 0;
        foreach ($cartItems as $cartItem) {
            $totalProductPrice += $cartItem->cartItemProductPrice();
            $totalDiscount += $cartItem->cartItemProductDiscount();
        }
    @endphp

    <section class="max-w-screen-xl mx-auto px-4 mb-6">

        {{-- Page header --}}
        <section class="flex justify-between items-center mb-5">
            <h2 class="flex items-center gap-2 text-lg font-bold text-gray-900">
                <span class="w-1.5 h-5 rounded-full bg-indigo-500 inline-block"></span>
                تکمیل اطلاعات حساب کاربری
            </h2>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">

            {{-- Form --}}
            <form id="profile_completion"
                  action="{{ route('customer.sales-process.profile.update') }}"
                  method="POST"
                  class="md:col-span-9 bg-white rounded-2xl shadow-sm p-5 md:p-6">
                @csrf

                <section class="flex items-start gap-3 bg-indigo-50 text-indigo-700 rounded-xl p-3 mb-6">
                    <i class="fa fa-info-circle mt-0.5 flex-shrink-0"></i>
                    <p class="text-sm leading-6">
                        اطلاعات حساب کاربری خود را (فقط یک بار، برای همیشه) وارد کنید. از این پس کالاها برای شخصی با این مشخصات ارسال می‌شود.
                    </p>
                </section>

                <section class="grid grid-cols-1 md:grid-cols-2 gap-y-5" style="column-gap: 2.5rem;">
                    @foreach($missingFields as $field)
                        <section>
                            <label for="{{ $field['key'] }}" class="block text-sm font-medium text-gray-700 mb-1.5 mt-4">
                                {{ $field['label'] }}
                            </label>
                            <input
                                type="text"
                                name="{{ $field['key'] }}"
                                id="{{ $field['key'] }}"
                                value="{{ old($field['key']) }}"
                                class="w-full rounded-lg border px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 transition-colors
                    {{ $errors->has($field['key'])
                        ? 'border-rose-300 focus:ring-rose-200'
                        : 'border-gray-200 focus:ring-indigo-200 focus:border-indigo-400' }}">
                            @error($field['key'])
                            <p class="text-xs text-rose-600 mt-1.5">{{ $message }}</p>
                            @enderror
                        </section>
                    @endforeach
                </section>
            </form>

            {{-- Order summary --}}
            <section class="md:col-span-3 bg-white rounded-2xl shadow-sm p-5 md:sticky md:top-4">
                <section class="flex justify-between items-center text-sm mb-3">
                    <span class="text-gray-500">قیمت کالاها ({{ $cartItems->count() }})</span>
                    <span class="text-gray-500"><span id="total_product_price">{{ priceFormat($totalProductPrice) }}</span> تومان</span>
                </section>

                @if($totalDiscount != 0)
                    <section class="flex justify-between items-center text-sm mb-3">
                        <span class="text-gray-500">تخفیف کالاها</span>
                        <span class="text-rose-600 font-bold"><span id="total_discount">{{ priceFormat($totalDiscount) }}</span> تومان</span>
                    </section>
                @endif

                <section class="border-t border-gray-100 my-3"></section>

                <section class="flex justify-between items-center text-sm mb-4">
                    <span class="text-gray-500">جمع سبد خرید</span>
                    <span class="font-bold text-gray-900"><span id="total_price">{{ priceFormat($totalProductPrice - $totalDiscount) }}</span> تومان</span>
                </section>

                <p class="text-xs text-gray-500 leading-6 flex gap-2 mb-4">
                    <i class="fa fa-info-circle mt-0.5 flex-shrink-0"></i>
                    <span>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه خواهد شد. و در نهایت پرداخت این سفارش صورت می‌گیرد.</span>
                </p>

                <button
                    type="button"
                    onclick="document.getElementById('profile_completion').submit();"
                    class="w-28 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg py-2.5 transition-colors">
                    تکمیل فرآیند خرید
                </button>
            </section>

        </section>
    </section>

@endsection
