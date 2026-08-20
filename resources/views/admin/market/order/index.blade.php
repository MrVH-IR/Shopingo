@extends('admin.layouts.master')

@section('head-tag')
    <title>سفارشات</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.category.index') }}" class="hover:text-slate-900">بخش فروش</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.order.all') }}" class="text-slate-900">سفارشات</a>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">سفارشات</h1>
                </div>
                <button disabled class="inline-flex items-center gap-2 rounded-2xl bg-slate-200 px-4 py-3 text-sm font-semibold text-slate-500">ایجاد سفارش</button>
            </div>
        </section>

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 p-4">
                <input type="text" placeholder="جستجو" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white lg:max-w-sm">
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-right">
                    <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">کد سفارش</th>
                            <th class="px-6 py-4">مجموع مبلغ سفارش</th>
                            <th class="px-6 py-4">مجموع تخفیف</th>
                            <th class="px-6 py-4">مبلغ تخفیف کالاها</th>
                            <th class="px-6 py-4">مبلغ نهایی</th>
                            <th class="px-6 py-4">وضعیت پرداخت</th>
                            <th class="px-6 py-4">شیوه پرداخت</th>
                            <th class="px-6 py-4">بانک</th>
                            <th class="px-6 py-4">وضعیت ارسال</th>
                            <th class="px-6 py-4">شیوه ارسال</th>
                            <th class="px-6 py-4">وضعیت سفارش</th>
                            <th class="px-6 py-4">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($orders as $order)
                            <tr class="hover:bg-slate-50/80">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $order->id }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ number_format($order->order_final_amount - $order->order_discount_amount) }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ number_format($order->order_discount_amount) }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ number_format($order->order_total_products_discounts_amount ?? 0) }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ number_format($order->order_final_amount) }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $order->paymentStatusValue }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $order->paymentTypeValue }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $order->payment?->paymentable?->gateway ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $order->deliveryStatusValue }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $order->delivery?->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $order->orderStatusValue }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-2 min-w-[20rem]">
                                        <a class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700" href="{{ route('admin.market.order.show', $order->id) }}">مشاهده فاکتور</a>
                                        <a class="inline-flex items-center gap-2 rounded-xl bg-cyan-50 px-3 py-2 text-sm font-semibold text-cyan-700" href="{{ route('admin.market.order.changeStatus', $order->id) }}">تغییر ارسال</a>
                                        <a class="inline-flex items-center gap-2 rounded-xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700" href="{{ route('admin.market.order.orderStatus', $order->id) }}">تغییر سفارش</a>
                                        <a class="inline-flex items-center gap-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700" href="{{ route('admin.market.order.cancelOrder', $order->id) }}">باطل</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 p-4">
                {{ $orders->links() }}
            </div>
        </section>
    </div>
@endsection
