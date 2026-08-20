@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>افزودن به فروش شگفت انگیز</title>
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
                        <a href="{{ route('admin.market.discount.amazingSale') }}" class="hover:text-slate-900">فروش شگفت انگیز</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">افزودن</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">افزودن به فروش شگفت انگیز</h1>
                </div>
                <a href="{{ route('admin.market.discount.amazingSale') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700"><i class="fas fa-arrow-right"></i> بازگشت</a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.discount.amazingSale.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="product" class="text-sm font-semibold text-slate-700">نام کالا</label>
                        <select name="product_id" id="product" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="">نام کالا را انتخاب کنید...</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="percentage" class="text-sm font-semibold text-slate-700">درصد تخفیف</label>
                        <input type="text" name="percentage" id="percentage" value="{{ old('percentage') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('percentage')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="start_at" class="text-sm font-semibold text-slate-700">تاریخ شروع</label>
                        <input type="text" id="start_at" name="start_at" value="{{ old('start_at') }}" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('start_at')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="end_at" class="text-sm font-semibold text-slate-700">تاریخ پایان</label>
                        <input type="text" id="end_at" name="end_at" value="{{ old('end_at') }}" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('end_at')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2 lg:col-span-2">
                        <label for="status" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="">انتخاب کنید</option>
                            <option value="0" @selected(old('status') == 0)>غیرفعال</option>
                            <option value="1" @selected(old('status') == 1)>فعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">ثبت</button>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
@endsection
