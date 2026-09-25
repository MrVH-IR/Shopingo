@extends('admin.layouts.master')

@section('head-tag')
    <title>اطلاعیه ایمیلی</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'اطلاعیه ایمیلی',
            'description' => 'ایجاد، ویرایش، فعال‌سازی و مدیریت فایل‌های اطلاعیه‌های ایمیلی.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'بخش اطلاع رسانی', 'url' => route('admin.email.index')],
                ['label' => 'اطلاعیه ایمیلی'],
            ],
            'actionUrl' => route('admin.email.create'),
            'actionLabel' => 'ایجاد اطلاعیه ایمیلی',
            'actionIcon' => 'fas fa-envelope',
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست اطلاعیه‌های ایمیلی</h2>
                    <p class="mt-1 text-sm text-slate-500">وضعیت و فایل‌های ضمیمه هر اطلاعیه در دسترس است.</p>
                </div>
                <div class="w-full max-w-sm">
                    <label for="search" class="sr-only">جستجو</label>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input id="search" type="text" placeholder="جستجو" name="search" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">#</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">متن ایمیل</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">تاریخ ارسال</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">وضعیت</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($emails as $key => $value)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ $value->subject }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $value->published_at_jalali }}</td>
                                    <td class="px-6 py-4">
                                        @include('admin.components.ui.status-toggle', [
                                            'id' => 'status-' . $value->id,
                                            'checked' => $value->status == 1,
                                            'url' => route('admin.email.status', $value->id),
                                            'onChange' => "changeStatus('status-{$value->id}')",
                                        ])
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap items-center justify-center gap-2">
                                            @if($value->files->isNotEmpty())
                                                <a href="{{ route('admin.email.file.view', $value->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                                    <i class="fas fa-paperclip"></i>
                                                    فایل ها
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.email.edit', $value->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-3 py-2 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                                <i class="fas fa-pen"></i>
                                                ویرایش
                                            </a>
                                            <form action="{{ route('admin.email.destroy', $value->id) }}" id="delete-form-{{ $value->id }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" form="delete-form-{{ $value->id }}" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $value->id }}">
                                                    <i class="fas fa-trash"></i>
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $emails->links('admin.layouts.pagination', ['title' => 'ایمیل ها']) }}
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
