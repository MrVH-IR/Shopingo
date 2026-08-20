@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد فرم کالا</title>
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
                        <span class="text-slate-900">ایجاد</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">ایجاد فرم کالا</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">فرم مشخصات را برای یک دسته کالا تعریف کنید.</p>
                </div>

                <a href="{{ route('admin.market.property.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.property.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-slate-700">نام فرم</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('name')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="category_id" class="text-sm font-semibold text-slate-700">فرم والد</label>
                        <select name="category_id" id="category_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="">فرم را انتخاب کنید</option>
                            @foreach($productCategories as $productCategory)
                                <option value="{{ $productCategory->id }}" @selected(old('category_id') == $productCategory->id)>{{ $productCategory->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="unit" class="text-sm font-semibold text-slate-700">واحد اندازه گیری</label>
                        <input type="text" name="unit" id="unit" value="{{ old('unit') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('unit')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="type" class="text-sm font-semibold text-slate-700">نوع نمایش ویژگی</label>
                        <select name="type" id="type" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="">انتخاب کنید</option>
                            <option value="text" @selected(old('type') == 'text')>فیلد متنی</option>
                            <option value="select" @selected(old('type') == 'select')>لیست انتخابی</option>
                            <option value="checkbox" @selected(old('type') == 'checkbox')>چک باکس</option>
                            <option value="radio" @selected(old('type') == 'radio')>رادیو باتن</option>
                            <option value="textarea" @selected(old('type') == 'textarea')>متن چند خطی</option>
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
