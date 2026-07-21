@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسته بندی محتوا</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.content.category.index') }}" class="hover:text-slate-900">دسته بندی</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">ویرایش</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">ویرایش دسته بندی محتوا</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">اطلاعات دسته بندی انتخاب‌شده را به‌روزرسانی کنید.</p>
                </div>

                <a href="{{ route('admin.content.category.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form id="form" action="{{ route('admin.content.category.update', $postCategory->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="Category" class="text-sm font-semibold text-slate-700">نام دسته</label>
                        <input type="text" name="name" id="Category" value="{{ old('name', $postCategory->name) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">
                        @error('name')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="Category-Select" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="Category-Select" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status', $postCategory->status) == 0)>غیر فعال</option>
                            <option value="1" @selected(old('status', $postCategory->status) == 1)>فعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="tags" class="text-sm font-semibold text-slate-700">برچسب‌ها</label>
                        <input type="hidden" name="tags" id="tags" value="{{ old('tags', $postCategory->tags) }}">
                        <select class="select2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white" id="select_tags" multiple></select>
                        @error('tags')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="image" class="text-sm font-semibold text-slate-700">تصویر جدید</label>
                        <input type="file" name="image" id="image" accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml" class="w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-cyan-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cyan-700">
                        @error('image')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror

                        @if(!empty($postCategory->image['indexArray']))
                            <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                @foreach($postCategory->image['indexArray'] as $key => $value)
                                    <label class="group cursor-pointer overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 transition hover:border-cyan-300">
                                        <input type="radio" class="sr-only" name="currentImage" value="{{ $key }}" @checked(($postCategory->image['currentImage'] ?? null) == $key)>
                                        <img src="{{ asset($value) }}" alt="{{ $postCategory->name }}" class="h-28 w-full object-cover transition group-hover:scale-[1.02]">
                                        <span class="block px-3 py-2 text-center text-xs font-semibold text-slate-500">تصویر {{ $loop->iteration }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="description" class="text-sm font-semibold text-slate-700">توضیحات</label>
                    <textarea name="description" id="description" rows="7" class="ckeditor w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">{{ old('description', $postCategory->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-rose-600">{{ $message }}</p>
                    @enderror
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

    <div id="imageModal" class="modal-overlay hidden fixed inset-0 z-[70] flex items-center justify-center bg-slate-950/80 px-4">
        <button type="button" class="close-btn absolute left-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-slate-700 shadow-lg" onclick="document.getElementById('imageModal').classList.add('hidden')">
            <i class="fas fa-times"></i>
        </button>
        <img class="modal-content max-h-[85vh] max-w-4xl rounded-3xl object-contain shadow-2xl" id="modalImage" alt="preview">
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
