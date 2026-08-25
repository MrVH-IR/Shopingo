@extends('admin.layouts.master')
@section('head-tag')<title>رنگ‌های کالا</title>@endsection
@section('content')
<div class="space-y-6">
    @include('admin.components.ui.page-header', [
        'title'=>'رنگ‌های کالا',
        'description'=>'مدیریت رنگ‌ها و افزایش قیمت مربوط به این کالا.',
        'breadcrumbs'=>[
            ['label'=>'خانه','url'=>route('admin.home')],
            ['label'=>'بخش فروش','url'=>route('admin.market.category.index')],
            ['label'=>'محصولات','url'=>route('admin.market.product.index')],
            ['label'=>'رنگ‌ها'],
        ],
        'actionUrl'=>route('admin.market.color.create', $product->id),
        'actionLabel'=>'ایجاد رنگ جدید',
        'actionIcon'=>'fas fa-palette',
    ])
    <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div><h2 class="text-lg font-bold text-slate-900">رنگ‌های {{ $product->name }}</h2><p class="mt-1 text-sm text-slate-500">رنگ‌های تعریف‌شده برای این کالا.</p></div>
            <div class="w-full max-w-sm"><div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3"><i class="fas fa-search text-slate-400"></i><input type="text" placeholder="جستجو" name="search" id="search" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400"></div></div>
        </div>
        <div class="overflow-hidden rounded-2xl border border-slate-200"><div class="overflow-x-auto"><table class="min-w-full divide-y divide-slate-200"><thead class="bg-slate-50"><tr>
            <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">#</th><th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">نام کالا</th><th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">رنگ کالا</th><th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">افزایش قیمت</th><th class="px-6 py-3 text-center text-xs font-semibold text-slate-500">تنظیمات</th>
        </tr></thead><tbody class="divide-y divide-slate-200 bg-white">
        @foreach($product->colors as $color)
            <tr class="transition hover:bg-slate-50"><td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $loop->iteration }}</td><td class="px-6 py-4 text-sm text-slate-600">{{ $product->name }}</td><td class="px-6 py-4 text-sm font-medium text-slate-700">{{ $color->color_name }}</td><td class="px-6 py-4 text-sm text-slate-600">{{ $color->price_increase }}</td><td class="px-6 py-4 text-center">
                <form method="POST" action="{{ route('admin.market.color.destroy', ['product'=>$product->id,'color'=>$color->id]) }}" id="delete-form-{{ $color->id }}" class="inline">@csrf @method('DELETE')<button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" form="delete-form-{{ $color->id }}" data-id="{{ $color->id }}"><i class="fas fa-trash"></i> حذف</button></form>
            </td></tr>
        @endforeach
        </tbody></table></div></div>
    </section>
</div>
@endsection
@section('script')@include('admin.alerts.sweetalert.delete-confirm',['className'=>'delete'])@endsection
