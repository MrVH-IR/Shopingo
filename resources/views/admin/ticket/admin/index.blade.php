@extends('admin.layouts.master')

@section('head-tag')
    <title>ادمین تیکت</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'ادمین تیکت',
            'description' => 'مدیریت ادمین‌هایی که به عنوان پاسخ‌گوی تیکت فعال هستند.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'بخش تیکت ها', 'url' => route('admin.ticket.index')],
                ['label' => 'ادمین تیکت'],
            ],
            'actionLabel' => 'ایجاد ادمین',
            'actionDisabled' => true,
            'actionIcon' => 'fas fa-plus',
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست ادمین ها</h2>
                    <p class="mt-1 text-sm text-slate-500">افزودن یا حذف دسترسی پاسخ‌گویی تیکت برای ادمین‌ها.</p>
                </div>
                <div class="w-full max-w-sm">
                    <label for="search" class="sr-only">جستجو</label>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input id="search" type="text" placeholder="جستجو" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">#</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">نام ادمین</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500">ایمیل ادمین</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-slate-500">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($admins as $key => $admin)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ $admin->fullName }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ $admin->email }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.ticket.admin.set', $admin->id) }}" class="inline-flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold transition {{ $admin->ticketAdmin == null ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-rose-50 text-rose-700 hover:bg-rose-100' }}">
                                            <i class="fas {{ $admin->ticketAdmin == null ? 'fa-user-plus' : 'fa-user-minus' }}"></i>
                                            {{ $admin->ticketAdmin == null ? 'اضافه' : 'حذف' }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
