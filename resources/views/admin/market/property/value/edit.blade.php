@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش مقدار فرم کالا</title>
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
                        <a href="{{ route('admin.market.value.index', $categoryAttribute->id) }}" class="hover:text-slate-900">مقادیر</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">ویرایش</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">ویرایش مقدار فرم کالا</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">مقدار و افزایش قیمت این ویژگی را اصلاح کنید.</p>
                </div>

                <a href="{{ route('admin.market.value.index', $categoryAttribute->id) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.value.update', ['categoryAttribute' => $categoryAttribute->id, 'value' => $value->id]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                @php $decoded = json_decode($value->value); @endphp

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="product_id" class="text-sm font-semibold text-slate-700">انتخاب محصول</label>
                        <select name="product_id" id="product_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="">محصول را انتخاب کنید</option>
                            @foreach($categoryAttribute->category->products as $product)
                                <option value="{{ $product->id }}" @selected(old('product_id', $value->product_id) == $product->id)>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="value" class="text-sm font-semibold text-slate-700">مقدار</label>
                        <input type="text" name="value" id="value" value="{{ old('value', $decoded->value ?? '') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('value')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="price_increase" class="text-sm font-semibold text-slate-700">افزایش قیمت</label>
                        <input type="text" name="price_increase" id="price_increase" value="{{ old('price_increase', $decoded->price_increase ?? '') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('price_increase')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="type" class="text-sm font-semibold text-slate-700">نوع</label>
                        <select name="type" id="type" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="">انتخاب کنید</option>
                            <option value="0" @selected(old('type', $value->type) == '0')>ساده</option>
                            <option value="1" @selected(old('type', $value->type) == '1')>انتخابی</option>
                        </select>
                        @error('type')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
