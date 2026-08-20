@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ایجاد کالا</title>
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
                        <a href="{{ route('admin.market.product.index') }}" class="hover:text-slate-900">کالاها</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">ایجاد</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">ایجاد کالا</h1>
                </div>
                <a href="{{ route('admin.market.product.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700"><i class="fas fa-arrow-right"></i> بازگشت</a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="form">
                @csrf
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">نام کالا</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('name')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">انتخاب دسته</label>
                        <select name="product_categories" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="">دسته را انتخاب کنید</option>
                            @foreach($productCategories as $id => $name)
                                <option value="{{ $id }}" @selected(old('product_categories') == $id)>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('product_categories')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">انتخاب برند</label>
                        <select name="brand_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="">برند را انتخاب کنید</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->original_name }} - {{ $brand->persian_name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">تصویر</label>
                        <input type="file" name="image" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        @error('image')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">قیمت</label>
                        <input type="text" name="price" value="{{ old('price') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('price')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">وزن</label>
                        <input type="text" name="weight" value="{{ old('weight') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('weight')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">طول</label>
                        <input type="text" name="length" value="{{ old('length') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('length')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">عرض</label>
                        <input type="text" name="width" value="{{ old('width') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('width')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">ارتفاع</label>
                        <input type="text" name="height" value="{{ old('height') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('height')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="">انتخاب کنید</option>
                            <option value="0" @selected(old('status') == 0)>غیرفعال</option>
                            <option value="1" @selected(old('status') == 1)>فعال</option>
                        </select>
                        @error('status')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">قابل فروش بودن</label>
                        <select name="marketable" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="">انتخاب کنید</option>
                            <option value="0" @selected(old('marketable') == 0)>غیرفعال</option>
                            <option value="1" @selected(old('marketable') == 1)>فعال</option>
                        </select>
                        @error('marketable')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">تاریخ انتشار</label>
                    <input type="text" name="published_at" id="published_at" value="{{ old('published_at') }}" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    <button type="button" id="calendar_icon" class="hidden"></button>
                    @error('published_at')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                    @enderror
                </div>
                </div>
                <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">تگ ها</label>
                        <input type="hidden" name="tags" id="tags" value="{{ old('tags') }}">
                        <select class="select2 w-full text-sm" id="select_tags" multiple></select>
                        @error('tags')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">توضیحات</label>
                    <textarea name="description" id="formbody" rows="8" class="ckeditor w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">خطا:</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror
                </div>
                <div class="border-t border-slate-100 pt-4">
                    <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">ثبت کالا</button>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2_new.js') }}"></script>
    <script>
        $(function () {
            jalaliDatepicker.startWatch({
                separatorChar: '/',
                time: true,
                dateFormat: 'YYYY/MM/DD HH:mm:ss'
            });
        });
    </script>
@endsection
