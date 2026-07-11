@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>سفارشات</title>
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
                            <i class="fa-solid fa-clock-rotate-left text-orange-500"></i>
                            تاریخچه سفارشات
                        </h2>
                    </div>

                    <!-- Filter tabs -->
                    <div class="flex flex-wrap gap-2 mb-6 pb-4 border-b border-gray-100">
                        <a href="{{ route('customer.profile.orders') }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                              {{ !request()->has('type')
                                  ? 'bg-orange-500 text-white'
                                  : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            همه
                        </a>
                        <a href="{{ route('customer.profile.orders', ['type' => 0]) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                              {{ request('type') == 0
                                  ? 'bg-sky-500 text-white'
                                  : 'bg-sky-50 text-sky-600 hover:bg-sky-100' }}">
                            بررسی نشده
                        </a>
                        <a href="{{ route('customer.profile.orders', ['type' => 1]) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                              {{ request('type') == 1
                                  ? 'bg-amber-500 text-white'
                                  : 'bg-amber-50 text-amber-600 hover:bg-amber-100' }}">
                            در انتظار تایید
                        </a>
                        <a href="{{ route('customer.profile.orders', ['type' => 2]) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                              {{ request('type') == 2
                                  ? 'bg-emerald-500 text-white'
                                  : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}">
                            تایید نشده
                        </a>
                        <a href="{{ route('customer.profile.orders', ['type' => 3]) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                              {{ request('type') == 3
                                  ? 'bg-rose-500 text-white'
                                  : 'bg-rose-50 text-rose-600 hover:bg-rose-100' }}">
                            تایید شده
                        </a>
                        <a href="{{ route('customer.profile.orders', ['type' => 4]) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                              {{ request('type') == 4
                                  ? 'bg-gray-800 text-white'
                                  : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            لغو باطل شده
                        </a>
                        <a href="{{ route('customer.profile.orders', ['type' => 5]) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                              {{ request('type') == 5
                                  ? 'bg-slate-500 text-white'
                                  : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                            مرجوع شده
                        </a>
                    </div>

                    <!-- Section title -->
                    <h3 class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-hourglass-half text-amber-500"></i>
                        در انتظار پرداخت
                    </h3>

                    <!-- Orders list -->
                    <div class="flex flex-col gap-3">
                        @forelse($orders as $order)
                            <div class="flex flex-col sm:flex-row items-center gap-4 border border-gray-100 rounded-xl p-4 hover:shadow-md transition-shadow duration-200">

                                <img src="{{ asset($order->orderItems?->first()?->product['image']['indexArray']['small']) }}"
                                     alt="عکس موجود نیست"
                                     class="w-20 h-20 rounded-lg object-cover flex-shrink-0 bg-gray-50">

                                <div class="flex-1 w-full">
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-500 mb-2">
                                    <span class="flex items-center gap-1">
                                        <i class="fa-solid fa-calendar-days text-gray-400"></i>
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d H:i:s') }}
                                    </span>
                                        <span class="flex items-center gap-1">
                                        <i class="fa-solid fa-id-card text-gray-400"></i>
                                        کد سفارش: {{ $order->id }}
                                    </span>
                                    </div>
                                    <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 text-xs font-medium px-3 py-1 rounded-full">
                                    <i class="fa-solid fa-clock"></i>
                                    {{ $order->payment_status_value }}
                                </span>
                                </div>

                                <a href="#"
                                   class="w-full sm:w-auto text-center bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-colors duration-200 flex-shrink-0">
                                    پرداخت سفارش
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400">
                                <i class="fa-solid fa-box-open text-3xl mb-3"></i>
                                <p>شما هیچ سفارشی ندارید.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </main>
        </div>
    </section>
@endsection
