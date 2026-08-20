@extends('admin.layouts.master')

@section('head-tag')
    <title>تخفیف عمومی</title>
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
                        <span class="text-slate-900">تخفیف عمومی</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">تخفیف عمومی</h1>
                </div>
                <a href="{{ route('admin.market.discount.commonDiscount.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white shadow-sm"><i class="fas fa-plus"></i> تخفیف جدید</a>
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
                            <th class="px-6 py-4">عنوان</th>
                            <th class="px-6 py-4">درصد</th>
                            <th class="px-6 py-4">کف خرید</th>
                            <th class="px-6 py-4">سقف تخفیف</th>
                            <th class="px-6 py-4">شروع</th>
                            <th class="px-6 py-4">پایان</th>
                            <th class="px-6 py-4">وضعیت</th>
                            <th class="px-6 py-4">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($commonDiscounts as $commonDiscount)
                            <tr class="hover:bg-slate-50/80">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $commonDiscount->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $commonDiscount->discount }}%</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $commonDiscount->discount_floor }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $commonDiscount->discount_ceiling }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ \Morilog\Jalali\Jalalian::fromCarbon($commonDiscount->start_at)->format('Y/m/d H:i:s') }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ \Morilog\Jalali\Jalalian::fromCarbon($commonDiscount->end_at)->format('Y/m/d H:i:s') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $commonDiscount->status ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                        {{ $commonDiscount->status ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.market.discount.commonDiscount.edit', $commonDiscount->id) }}" class="delete inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700"><i class="fas fa-pen"></i> ویرایش</a>
                                        <form method="POST" action="{{ route('admin.market.discount.commonDiscount.destroy', $commonDiscount->id) }}" id="delete-form-{{ $commonDiscount->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white" form="delete-form-{{ $commonDiscount->id }}"><i class="fas fa-trash"></i> حذف</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 p-4">
                {{ $commonDiscounts->links() }}
            </div>
        </section>
    </div>
@endsection

@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
