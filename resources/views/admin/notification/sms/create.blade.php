@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ایجاد اطلاعیه پیامک</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'ایجاد اطلاعیه پیامک',
            'description' => 'اطلاعات اطلاعیه پیامک را تکمیل کنید.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'اطلاع رسانی', 'url' => route('admin.sms.index')],
                ['label' => 'اطلاعیه پیامک', 'url' => route('admin.sms.index')],
                ['label' => 'ایجاد'],
            ],
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فرم اطلاعیه پیامک</h2>
                    <p class="mt-1 text-sm text-slate-500">فیلدهای مورد نیاز را تکمیل کنید.</p>
                </div>
                <a href="{{ route('admin.sms.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>

            <form action="{{ route('admin.sms.store') }}" method="POST"  class="space-y-6">
                @csrf

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-semibold text-slate-700">عنوان پیامک</label>
                        <input type="text" name="title" id="title" value="{{ old('subject') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                        @include('admin.components.ui.field-error', ['name' => 'title'])
                    </div>

                    <div class="space-y-2">
                        <label for="published_at" class="text-sm font-semibold text-slate-700">تاریخ انتشار</label>
                        <div class="relative">
                            <input type="text" id="published_at" name="published_at" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100 pl-12 jalali-input" data-jdp data-jdp-format="YYYY-MM-DD" value="{{ old('published_at') }}">
                            <i class="fas fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                        @include('admin.components.ui.field-error', ['name' => 'published_at'])
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="body" class="text-sm font-semibold text-slate-700">متن پیامک</label>
                        <textarea name="body" id="body" class="ckeditor min-h-60 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white" rows="10">{{ old('body') }}</textarea>
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
