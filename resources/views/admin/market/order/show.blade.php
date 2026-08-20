@extends('admin.layouts.master')

@section('head-tag')
    <title>فاکتور سفارش</title>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printable, #printable * {
                visibility: visible;
            }
            #printable {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm no-print">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.category.index') }}" class="hover:text-slate-900">بخش فروش</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.order.all') }}" class="hover:text-slate-900">سفارشات</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">فاکتور</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">فاکتور سفارش #{{ $order->id }}</h1>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.market.order.showDetail', $order->id) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700"><i class="fas fa-book"></i> جزئیات</a>
                    <button type="button" id="print" class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white"><i class="fas fa-print"></i> چاپ فاکتور</button>
                </div>
            </div>
        </section>

        <section id="printable" class="space-y-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between border-b border-dashed border-slate-200 pb-4">
                <div>
                    <h2 class="text-xl font-black text-slate-900">فاکتور سفارش #{{ $order->id }}</h2>
                    <p class="mt-1 text-sm text-slate-500">تاریخ ثبت سفارش: {{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d H:i:s') }}</p>
                </div>
                <span class="rounded-full bg-cyan-50 px-3 py-1 text-xs font-bold text-cyan-700">نسخه چاپ</span>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <h3 class="mb-4 text-lg font-black text-slate-900">اطلاعات گیرنده</h3>
                    <dl class="grid gap-3 text-sm text-slate-700">
                        <div class="flex justify-between gap-4"><dt>نام</dt><dd class="font-semibold">{{ $order->address->recipient_first_name ?? '-' }}</dd></div>
                        <div class="flex justify-between gap-4"><dt>نام خانوادگی</dt><dd class="font-semibold">{{ $order->address->recipient_last_name ?? '-' }}</dd></div>
                        <div class="flex justify-between gap-4"><dt>موبایل</dt><dd class="font-semibold">{{ $order->address->mobile ?? '-' }}</dd></div>
                        <div class="flex justify-between gap-4"><dt>کد پستی</dt><dd class="font-semibold">{{ $order->address->postal_code ?? '-' }}</dd></div>
                        <div class="rounded-2xl bg-white p-4">
                            <dt class="mb-1 text-slate-500">آدرس</dt>
                            <dd class="font-semibold leading-7">{{ $order->address->address ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                    <h3 class="mb-4 text-lg font-black text-slate-900">اطلاعات پرداخت</h3>
                    <dl class="grid gap-3 text-sm text-slate-700">
                        <div class="flex justify-between gap-4"><dt>نوع پرداخت</dt><dd class="font-semibold">{{ $order->paymentTypeValue }}</dd></div>
                        <div class="flex justify-between gap-4"><dt>وضعیت پرداخت</dt><dd class="font-semibold">{{ $order->paymentStatusValue }}</dd></div>
                        <div class="flex justify-between gap-4"><dt>بانک</dt><dd class="font-semibold">{{ $order->payment?->paymentable?->gateway ?? '-' }}</dd></div>
                    </dl>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5 lg:col-span-2">
                    <h3 class="mb-4 text-lg font-black text-slate-900">مبالغ</h3>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl bg-white p-4">
                            <p class="text-sm text-slate-500">مبلغ سفارش</p>
                            <p class="mt-1 text-lg font-bold text-slate-900">{{ number_format($order->order_final_amount) }}</p>
                        </div>
                        <div class="rounded-2xl bg-white p-4">
                            <p class="text-sm text-slate-500">تخفیف</p>
                            <p class="mt-1 text-lg font-bold text-slate-900">{{ number_format($order->order_discount_amount) }}</p>
                        </div>
                        <div class="rounded-2xl bg-cyan-50 p-4">
                            <p class="text-sm text-cyan-700">مبلغ نهایی</p>
                            <p class="mt-1 text-lg font-black text-cyan-900">{{ number_format($order->order_final_amount - $order->order_discount_amount) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-2 text-center text-xs text-slate-500">
                تاریخ چاپ فاکتور: {{ \Morilog\Jalali\Jalalian::fromCarbon(now())->format('Y/m/d H:i:s') }}
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('print').addEventListener('click', function () {
            window.print();
        });
    </script>
@endsection
