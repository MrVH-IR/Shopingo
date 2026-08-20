@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش پرداخت</title>
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
                        <a href="{{ route('admin.market.payment.index') }}" class="hover:text-slate-900">پرداخت ها</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">نمایش</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">نمایش پرداخت</h1>
                </div>
                <a href="{{ route('admin.market.payment.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700"><i class="fas fa-arrow-right"></i> بازگشت</a>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">پرداخت کننده</p>
                        <h2 class="mt-1 text-xl font-black text-slate-900">{{ $payment->user?->fullName }} - {{ $payment->user?->mobile }}</h2>
                    </div>
                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold
                        @if($payment->status == 1) bg-emerald-100 text-emerald-700
                        @elseif($payment->status == 2) bg-amber-100 text-amber-700
                        @elseif($payment->status == 3) bg-rose-100 text-rose-700
                        @else bg-slate-100 text-slate-700
                        @endif">
                        @if($payment->status == 0) پرداخت نشده
                        @elseif($payment->status == 1) پرداخت شده
                        @elseif($payment->status == 2) پرداخت کنسل شده
                        @elseif($payment->status == 3) برگشت داده شده
                        @endif
                    </span>
                </div>

                <dl class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">مبلغ پرداخت شده</dt>
                        <dd class="mt-1 text-lg font-bold text-slate-900">{{ $payment->amount }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">درگاه</dt>
                        <dd class="mt-1 text-lg font-bold text-slate-900">{{ $payment->paymentable->gateway ?? '-' }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">کد تراکنش</dt>
                        <dd class="mt-1 text-lg font-bold text-slate-900">{{ $payment->paymentable->transaction_id ?? '-' }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">نوع پرداخت</dt>
                        <dd class="mt-1 text-lg font-bold text-slate-900">
                            @if($payment->type == 0)
                                آنلاین
                            @elseif($payment->type == 1)
                                آفلاین
                            @else
                                در محل
                            @endif
                        </dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">تاریخ پرداخت</dt>
                        <dd class="mt-1 text-lg font-bold text-slate-900">
                            @if($payment->paymentable->pay_date)
                                {{ \Morilog\Jalali\Jalalian::fromCarbon($payment->paymentable->pay_date)->format('Y/m/d') }}
                            @elseif($payment->paymentable->paid_date)
                                {{ \Morilog\Jalali\Jalalian::fromCarbon($payment->paymentable->paid_date)->format('Y/m/d') }}
                            @else
                                -
                            @endif
                        </dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-sm text-slate-500">گیرنده</dt>
                        <dd class="mt-1 text-lg font-bold text-slate-900">{{ $payment->paymentable->cash_receiver ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <aside class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-black text-slate-900">عملیات</h3>
                <div class="mt-4 space-y-3">
                    <a href="{{ route('admin.market.payment.confirm', $payment->id) }}" class="flex items-center justify-between rounded-2xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100">
                        <span>پرداخت شده</span>
                        <i class="fas fa-check"></i>
                    </a>
                    <a href="{{ route('admin.market.payment.canceled', $payment->id) }}" class="flex items-center justify-between rounded-2xl bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                        <span>باطل کردن</span>
                        <i class="fas fa-times"></i>
                    </a>
                    <a href="{{ route('admin.market.payment.returned', $payment->id) }}" class="flex items-center justify-between rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">
                        <span>برگرداندن</span>
                        <i class="fas fa-rotate-left"></i>
                    </a>
                </div>
            </aside>
        </section>
    </div>
@endsection
