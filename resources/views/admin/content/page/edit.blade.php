@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پیج</title>
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
                            <a href="{{ route('admin.content.page.index') }}" class="transition hover:text-white">پیج ساز</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">ویرایش</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">ویرایش پیج</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            عنوان، محتوا، تگ‌ها و وضعیت این صفحه را به‌روزرسانی کنید.
                        </p>
                    </div>

                    <a href="{{ route('admin.content.page.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-arrow-right text-cyan-700"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form id="form" action="{{ route('admin.content.page.update', $page->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-semibold text-slate-700">عنوان</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">
                        @error('title')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="Category-Select" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="Category-Select" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status', $page->status) == 0)>غیر فعال</option>
                            <option value="1" @selected(old('status', $page->status) == 1)>فعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="tags" class="text-sm font-semibold text-slate-700">برچسب‌ها</label>
                        <input type="hidden" name="tags" id="tags" value="{{ old('tags', $page->tags) }}">
                        <select class="select2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white" id="select_tags" multiple></select>
                        @error('tags')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="body" class="text-sm font-semibold text-slate-700">محتوا</label>
                        <textarea name="body" id="body" rows="10" class="ckeditor w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">{{ old('body', $page->body) }}</textarea>
                        @error('body')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="customStyle" class="text-sm font-semibold text-slate-700">توجه: اگر قسمت محتوا را پر کرده اید این قسمت را خالی بگذارید. فقط یک قسمت را میتوانید پر کنید.</label>
                        <br>
                        <label for="customStyle" class="text-sm font-semibold text-slate-700">شخصی سازی با استفاده از تگ ها و استایل های HTML CSS</label>
                        <textarea name="customStyle" id="customStyle" rows="10" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">{{ old('body', $page->body) }}</textarea>
                        @error('customStyle')
                        <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت تغییرات
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
