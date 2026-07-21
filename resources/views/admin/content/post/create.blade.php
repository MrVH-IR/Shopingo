@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ایجاد پست</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="relative isolate overflow-hidden px-6 py-7 sm:px-8">
                <div class="absolute inset-0 -z-10 bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-900"></div>
                <div class="absolute right-0 top-0 -z-10 h-40 w-40 rounded-full bg-cyan-400/20 blur-3xl"></div>
                <div class="absolute bottom-0 left-1/3 -z-10 h-32 w-32 rounded-full bg-fuchsia-400/10 blur-3xl"></div>

                <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <nav class="mb-3 text-sm text-slate-300">
                            <a href="{{ route('admin.home') }}" class="transition hover:text-white">خانه</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <a href="{{ route('admin.content.post.index') }}" class="transition hover:text-white">پست‌ها</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">ایجاد</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">ایجاد پست</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            مقاله جدید را با تصویر، دسته، تاریخ انتشار و تگ‌ها ثبت کنید.
                        </p>
                    </div>

                    <a href="{{ route('admin.content.post.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-arrow-right text-cyan-700"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form id="form" action="{{ route('admin.content.post.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-semibold text-slate-700">عنوان پست</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">
                        @error('title')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="Category-Select" class="text-sm font-semibold text-slate-700">دسته</label>
                        <select name="category_id" id="Category-Select" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="">دسته را انتخاب کنید</option>
                            @foreach($postCategories as $id => $name)
                                <option value="{{ $id }}" @selected(old('category_id') == $id)>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="image" class="text-sm font-semibold text-slate-700">تصویر</label>
                        <input type="file" name="image" id="image" accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml" class="w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-cyan-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cyan-700">
                        @error('image')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="published_at" class="text-sm font-semibold text-slate-700">تاریخ انتشار</label>
                        <div class="relative">
                            <input type="text" id="published_at" name="published_at" value="{{ old('published_at') }}" data-jdp data-jdp-format="YYYY/MM/DD" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-11 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">
                            <i class="fas fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                        @error('published_at')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="Status-Select" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="Status-Select" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status') == 0)>غیر فعال</option>
                            <option value="1" @selected(old('status') == 1)>فعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="Commentable-Select" class="text-sm font-semibold text-slate-700">امکان درج کامنت</label>
                        <select name="commentable" id="Commentable-Select" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('commentable') == 0)>غیر فعال</option>
                            <option value="1" @selected(old('commentable') == 1)>فعال</option>
                        </select>
                        @error('commentable')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="tags" class="text-sm font-semibold text-slate-700">برچسب‌ها</label>
                        <input type="hidden" name="tags" id="tags" value="{{ old('tags') }}">
                        <select class="select2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white" id="select_tags" multiple></select>
                        @error('tags')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="summary" class="text-sm font-semibold text-slate-700">خلاصه پست</label>
                        <textarea name="summary" id="summary" rows="5" class="ckeditor w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">{{ old('summary') }}</textarea>
                        @error('summary')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="body" class="text-sm font-semibold text-slate-700">محتوا</label>
                        <textarea class="ckeditor w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white" rows="10" name="body" id="body">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-4 border-t border-slate-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="hidden sm:block text-sm text-slate-500">
                        تصویر، دسته، تاریخ انتشار و محتوای اصلی را قبل از ثبت بررسی کنید.
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت پست
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
