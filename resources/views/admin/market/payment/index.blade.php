@extends('admin.layouts.master')

@section('head-tag')
    <title>پرداخت ها</title>
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
                        <span class="text-slate-900">پرداخت ها</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">پرداخت ها</h1>
                </div>
                <button disabled class="inline-flex items-center gap-2 rounded-2xl bg-slate-200 px-4 py-3 text-sm font-semibold text-slate-500">پرداخت جدید</button>
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
                            <th class="px-6 py-4">کد تراکنش</th>
                            <th class="px-6 py-4">بانک</th>
                            <th class="px-6 py-4">پرداخت کننده</th>
                            <th class="px-6 py-4">وضعیت پرداخت</th>
                            <th class="px-6 py-4">نوع پرداخت</th>
                            <th class="px-6 py-4">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($allPayments as $payment)
                            <tr class="hover:bg-slate-50/80">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $payment->paymentable->transaction_id ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $payment->paymentable->gateway ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $payment->user->mobile }} - {{ $payment->user->fullName }}</td>
                                <td class="px-6 py-4">
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
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700">
                                    @if($payment->type == 0)
                                        آنلاین
                                    @elseif($payment->type == 1)
                                        آفلاین
                                    @else
                                        در محل
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <a href="{{ route('admin.market.payment.show', $payment->id) }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700"><i class="fas fa-eye"></i> مشاهده</a>
                                        <a href="{{ route('admin.market.payment.canceled', $payment->id) }}" class="inline-flex items-center gap-2 rounded-xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100"><i class="fas fa-times"></i> باطل کردن</a>
                                        <a href="{{ route('admin.market.payment.returned', $payment->id) }}" class="inline-flex items-center gap-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100"><i class="fas fa-rotate-left"></i> برگرداندن</a>
                                        <a href="{{ route('admin.market.payment.confirm', $payment->id) }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-50 px-3 py-2 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100"><i class="fas fa-check"></i> پرداخت شده</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 p-4">
                {{ $allPayments->links() }}
            </div>
        </section>
    </div>
@endsection
