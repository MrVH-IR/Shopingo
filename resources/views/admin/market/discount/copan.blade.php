@extends('admin.layouts.master')

@section('head-tag')
    <title>کوپن تخفیف</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">کوپن تخفیف</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">کوپن تخفیف</h1>
                    <p class="mt-2 text-sm text-slate-500">مدیریت کدهای تخفیف عمومی و خصوصی.</p>
                </div>
                <a href="{{ route('admin.market.discount.copan.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white">
                    <i class="fas fa-plus"></i> ایجاد کوپن
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">لیست کوپن ها</h2>
                </div>
                <div class="w-full max-w-sm">
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input type="text" id="search" placeholder="جستجو" class="w-full bg-transparent text-sm outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-right text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 font-semibold">#</th>
                                <th class="px-4 py-3 font-semibold">کد</th>
                                <th class="px-4 py-3 font-semibold">میزان</th>
                                <th class="px-4 py-3 font-semibold">نوع مبلغ</th>
                                <th class="px-4 py-3 font-semibold">سقف</th>
                                <th class="px-4 py-3 font-semibold">نوع کوپن</th>
                                <th class="px-4 py-3 font-semibold">شروع</th>
                                <th class="px-4 py-3 font-semibold">پایان</th>
                                <th class="px-4 py-3 font-semibold">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($coupans as $coupan)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-4 py-4 font-semibold text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4 font-medium text-slate-900">{{ $coupan->code }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $coupan->amount }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $coupan->amount_type == 0 ? 'درصدی' : 'عددی' }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $coupan->discount_ceiling ?? 'ندارد' }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $coupan->type == 0 ? 'عمومی' : 'خصوصی' }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ \Morilog\Jalali\Jalalian::fromCarbon($coupan->start_date) }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ \Morilog\Jalali\Jalalian::fromCarbon($coupan->end_date) }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.market.discount.coupon.edit', $coupan->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700">
                                                <i class="fas fa-pen"></i> ویرایش
                                            </a>
                                            <form method="POST" action="{{ route('admin.market.discount.coupon.destroy', $coupan->id) }}" id="delete-form-{{ $coupan->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700" data-id="{{ $coupan->id }}">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="9" class="px-4 py-16 text-center text-slate-500">هنوز کوپنی ثبت نشده است.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">{{ $coupans->links() }}</div>
        </section>
    </div>
@endsection

@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
