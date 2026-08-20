@extends('admin.layouts.master')

@section('head-tag')
    <title>جزئیات سفارش</title>
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
                        <a href="{{ route('admin.market.order.all') }}" class="hover:text-slate-900">سفارشات</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">جزئیات</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">جزئیات سفارش #{{ $order->id }}</h1>
                </div>
                <a href="{{ route('admin.market.order.show', $order->id) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700"><i class="fas fa-file-invoice"></i> فاکتور</a>
            </div>
        </section>

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-right">
                    <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">نام محصول</th>
                            <th class="px-6 py-4">درصد فروش فوق العاده</th>
                            <th class="px-6 py-4">مبلغ فروش فوق العاده</th>
                            <th class="px-6 py-4">تعداد</th>
                            <th class="px-6 py-4">جمع قیمت محصول</th>
                            <th class="px-6 py-4">مبلغ نهایی</th>
                            <th class="px-6 py-4">رنگ</th>
                            <th class="px-6 py-4">گارانتی</th>
                            <th class="px-6 py-4">ویژگی ها</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($order->orderItems as $item)
                            <tr class="hover:bg-slate-50/80 align-top">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->singleProduct->name ?? '' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->amazingSale->percentage ?? '' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->amazing_discount_amount ?? '' }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->number ?? '' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->final_product_price ?? 0 }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->final_total_price ?? '' }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->color->color_name ?? '' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->guarantee->name ?? '' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">
                                    @forelse($item->orderItemAttributes as $attribute)
                                        <div class="mb-1">{{ $attribute->categoryAttribute->name ?? '' }}: {{ $attribute->categoryValueAttribute->type ?? '' }}</div>
                                    @empty
                                        -
                                    @endforelse
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
