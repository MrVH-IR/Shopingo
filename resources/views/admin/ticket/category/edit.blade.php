@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسته بندی</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'ویرایش دسته بندی',
            'description' => 'فیلدهای دسته بندی را ثبت یا ویرایش کنید.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'بخش تیکت ها', 'url' => route('admin.ticket.index')],
                ['label' => 'دسته بندی', 'url' => route('admin.ticket.category.index')],
                ['label' => 'ویرایش'],
            ],
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">اطلاعات دسته بندی</h2>
                    <p class="mt-1 text-sm text-slate-500">مقادیر را وارد کنید و فرم را ثبت کنید.</p>
                </div>
                <a href="{{ route('admin.ticket.category.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>

            <form action="{{ route('admin.ticket.category.update', $ticketCategory->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-slate-700">نام دسته</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $ticketCategory->name) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                        @include('admin.components.ui.field-error', ['name' => 'name'])
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100">
                            <option value="0" @selected(old('status', $ticketCategory->status) == 0)>غیرفعال</option>
                            <option value="1" @selected(old('status', $ticketCategory->status) == 1)>فعال</option>
                        </select>
                        @include('admin.components.ui.field-error', ['name' => 'status'])
                    </div>
                </div>

                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت دسته بندی
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
