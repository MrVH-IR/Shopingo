@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ویرایش تنظیمات سایت</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'ویرایش تنظیمات سایت',
            'description' => 'اطلاعات پایه سایت و فایل‌های اصلی برند را ویرایش کنید.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'تنظیمات', 'url' => route('admin.setting.index')],
                ['label' => 'ویرایش تنظیمات'],
            ],
            'actionUrl' => route('admin.setting.index'),
            'actionLabel' => 'بازگشت',
            'actionIcon' => 'fas fa-arrow-right',
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-semibold text-slate-700">عنوان سایت</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $setting->title) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                        @include('admin.components.ui.field-error', ['name' => 'title'])
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-semibold text-slate-700">توضیحات سایت</label>
                        <input type="text" name="description" id="description" value="{{ old('description', $setting->description) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                        @include('admin.components.ui.field-error', ['name' => 'description'])
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="keywords" class="text-sm font-semibold text-slate-700">کلمات کلیدی سایت</label>
                        <input type="text" name="keywords" id="keywords" value="{{ old('keywords', $setting->keywords) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                        @include('admin.components.ui.field-error', ['name' => 'keywords'])
                    </div>

                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-700"><i class="fas fa-image"></i></div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800">لوگو</p>
                                <p class="text-xs text-slate-500">فایل جدید را برای جایگزینی انتخاب کنید.</p>
                            </div>
                        </div>
                        <input type="file" id="logo" name="logo" accept="image/png,image/jpg,image/jpeg,image/webp,image/svg" class="mt-4 block w-full text-sm text-slate-600 file:ml-4 file:rounded-xl file:border-0 file:bg-cyan-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cyan-700">
                        <p id="file-chosen" class="mt-2 text-xs text-slate-500">هیچ فایلی انتخاب نشده</p>
                        @include('admin.components.ui.field-error', ['name' => 'logo'])
                    </div>

                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-50 text-cyan-700"><i class="fas fa-star"></i></div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800">Favicon</p>
                                <p class="text-xs text-slate-500">فایل favicon جدید را انتخاب کنید.</p>
                            </div>
                        </div>
                        <input type="file" id="favicon" name="favicon" accept="image/png,image/x-icon,image/vnd.microsoft.icon,image/svg+xml" class="mt-4 block w-full text-sm text-slate-600 file:ml-4 file:rounded-xl file:border-0 file:bg-cyan-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cyan-700">
                        <p id="file-chosen-favicon" class="mt-2 text-xs text-slate-500">هیچ فایلی انتخاب نشده</p>
                        @include('admin.components.ui.field-error', ['name' => 'icon'])
                    </div>
                </div>

                <div class="flex justify-end border-t border-slate-100 pt-4">
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
    <script>
        document.getElementById('logo')?.addEventListener('change', function () {
            document.getElementById('file-chosen').textContent = this.files[0]?.name || 'هیچ فایلی انتخاب نشده';
        });

        document.getElementById('favicon')?.addEventListener('change', function () {
            document.getElementById('file-chosen-favicon').textContent = this.files[0]?.name || 'هیچ فایلی انتخاب نشده';
        });
    </script>
@endsection
