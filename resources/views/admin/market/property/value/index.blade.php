@extends('admin.layouts.master')

@section('head-tag')
    <title>مقدار فرم کالا</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.property.index') }}" class="hover:text-slate-900">فرم کالا</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">مقادیر</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">مقادیر فرم کالا</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">مقادیر هر فرم را برای محصولات مرتبط مدیریت کنید.</p>
                </div>

                <a href="{{ route('admin.market.value.create', $categoryAttribute->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                    <i class="fas fa-plus"></i>
                    ایجاد مقدار جدید
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="overflow-hidden rounded-3xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-right text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 font-semibold">#</th>
                                <th class="px-4 py-3 font-semibold">نام فرم</th>
                                <th class="px-4 py-3 font-semibold">نام محصول</th>
                                <th class="px-4 py-3 font-semibold">مقدار</th>
                                <th class="px-4 py-3 font-semibold">افزایش قیمت</th>
                                <th class="px-4 py-3 font-semibold">نوع</th>
                                <th class="px-4 py-3 font-semibold">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($categoryAttribute->values as $value)
                                @php $decoded = json_decode($value->value); @endphp
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-4 py-4 font-semibold text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4 font-medium text-slate-900">{{ $categoryAttribute->name }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $value->product->name }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $decoded->value ?? '' }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $decoded->price_increase ?? '' }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $value->type == 0 ? 'ساده' : 'انتخابی' }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.market.value.edit', ['categoryAttribute' => $categoryAttribute->id, 'value' => $value->id]) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                                <i class="fas fa-pen"></i>
                                                ویرایش
                                            </a>
                                            <form method="POST" action="{{ route('admin.market.value.destroy', ['categoryAttribute' => $categoryAttribute->id, 'value' => $value->id]) }}" id="delete-form-{{ $value->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $value->id }}">
                                                    <i class="fas fa-trash"></i>
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-16 text-center text-slate-500">هنوز مقداری ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
