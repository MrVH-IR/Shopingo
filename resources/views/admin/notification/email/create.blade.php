@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ایجاد اطلاعیه ایمیل</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'ایجاد اطلاعیه ایمیل',
            'description' => 'اطلاعات اطلاعیه ایمیل را تکمیل کنید.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'اطلاع رسانی', 'url' => route('admin.email.index')],
                ['label' => 'اطلاعیه ایمیل', 'url' => route('admin.email.index')],
                ['label' => 'ایجاد'],
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

            <form action="{{ route('admin.email.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="subject" class="text-sm font-semibold text-slate-700">عنوان ایمیل</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                        @include('admin.components.ui.field-error', ['name' => 'subject'])
                    </div>

                    <div class="space-y-2">
                        <label for="published_at" class="text-sm font-semibold text-slate-700">تاریخ انتشار</label>
                        <div class="relative">
                            <input type="text" id="published_at" name="published_at" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100 pl-12 jalali-input" data-jdp data-jdp-format="YYYY-MM-DD" value="{{ old('published_at') }}">
                            <i class="fas fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                        @include('admin.components.ui.field-error', ['name' => 'published_at'])
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status') == 0)>غیرفعال</option>
                            <option value="1" @selected(old('status') == 1)>فعال</option>
                        </select>
                        @include('admin.components.ui.field-error', ['name' => 'status'])
                    </div>

                    <div class="space-y-3 lg:col-span-2">
                        <div class="grid gap-4 sm:grid-cols-2">
                            @for($i = 0; $i < 2; $i++)
                                <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4">
                                    <label for="file_{{ $i }}" class="flex cursor-pointer items-center gap-3 text-sm font-semibold text-slate-700">
                                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-700"><i class="fas fa-paperclip"></i></span>
                                        انتخاب فایل پیوست
                                    </label>
                                    <input type="file" id="file_{{ $i }}" name="files[]" class="mt-3 block w-full text-sm text-slate-600 file:ml-4 file:rounded-xl file:border-0 file:bg-cyan-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cyan-700">
                                    <p id="file-chosen-{{ $i }}" class="mt-2 text-xs text-slate-500">هیچ فایلی انتخاب نشده</p>
                                    @include('admin.components.ui.field-error', ['name' => "files.$i"])
                                </div>
                            @endfor
                        </div>
                    </div>
                    

                    <div class="space-y-2 lg:col-span-2">
                        <label for="body" class="text-sm font-semibold text-slate-700">متن ایمیل</label>
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
    <script>
            document.querySelectorAll('input[type="file"][name="files[]"]').forEach(function (input) {
                input.addEventListener('change', function () {
                    const target = document.getElementById('file-chosen-' + this.id.replace('file_', ''));
                    if (target) target.textContent = this.files[0]?.name || 'هیچ فایلی انتخاب نشده';
                });
            });
        </script>
@endsection
