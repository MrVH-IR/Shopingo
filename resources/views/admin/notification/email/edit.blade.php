@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ویرایش اطلاعیه ایمیل</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'ویرایش اطلاعیه ایمیل',
            'description' => 'اطلاعات اطلاعیه ایمیل را تکمیل کنید.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'اطلاع رسانی', 'url' => route('admin.email.index')],
                ['label' => 'اطلاعیه ایمیل', 'url' => route('admin.email.index')],
                ['label' => 'ویرایش'],
            ],
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فرم اطلاعیه ایمیل</h2>
                    <p class="mt-1 text-sm text-slate-500">فیلدهای مورد نیاز را تکمیل کنید.</p>
                </div>
                <a href="{{ route('admin.email.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>

            <form action="{{ route('admin.email.update', $email->id) }}" method="POST"  class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="subject" class="text-sm font-semibold text-slate-700">عنوان ایمیل</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject', $email->subject) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                        @include('admin.components.ui.field-error', ['name' => 'subject'])
                    </div>

                    <div class="space-y-2">
                        <label for="published_at" class="text-sm font-semibold text-slate-700">تاریخ انتشار</label>
                        <div class="relative">
                            <input type="text" id="published_at" name="published_at" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100 pl-12 jalali-input" data-jdp data-jdp-format="YYYY-MM-DD" value="{{ old('published_at', $email->published_at_jalali) }}">
                            <i class="fas fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                        @include('admin.components.ui.field-error', ['name' => 'published_at'])
                    </div>

                    @if($email->files)
                        <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <div class="mb-3 flex items-center gap-2">
                                <i class="fas fa-paperclip text-cyan-600"></i>
                                <p class="text-sm font-semibold text-slate-700">فایل‌های پیوست</p>
                            </div>
                            <div class="space-y-3">
                                @foreach($email->files as $file)
                                    <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 sm:flex-row sm:items-center sm:justify-between">
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-slate-800">{{ $file->file_path }}</p>
                                            <p class="mt-1 text-xs text-slate-500">فایل پیوست اطلاعیه</p>
                                        </div>
                                        <a href="{{ route('admin.email.file.download', $file->id) }}" target="_blank" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-2xl bg-cyan-50 px-4 py-3 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                            <i class="fas fa-download"></i>
                                            مشاهده / دانلود
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="space-y-2 lg:col-span-2">
                        <label for="body" class="text-sm font-semibold text-slate-700">متن ایمیل</label>
                        <textarea name="body" id="body" class="ckeditor min-h-60 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white" rows="10">{{ old('body', $email->body) }}</textarea>
                        @include('admin.components.ui.field-error', ['name' => 'body'])
                    </div>
                </div>

                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت اطلاعیه
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

@endsection
