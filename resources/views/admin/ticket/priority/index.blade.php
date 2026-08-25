@extends('admin.layouts.master')

@section('head-tag')
    <title>اولویت تیکت</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'اولویت تیکت',
            'description' => 'مدیریت اولویت‌های تیکت و وضعیت فعال بودن آن‌ها.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'بخش تیکت ها', 'url' => route('admin.ticket.index')],
                ['label' => 'اولویت'],
            ],
            'actionUrl' => route('admin.ticket.priority.create'),
            'actionLabel' => 'ایجاد اولویت',
        ])

        @include('admin.alerts.alertsection.success')

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست اولویت ها</h2>
                    <p class="mt-1 text-sm text-slate-500">وضعیت اولویت‌ها را مستقیم از همین جدول مدیریت کنید.</p>
                </div>
                <div class="w-full max-w-sm">
                    <label for="search" class="sr-only">جستجو</label>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input id="search" type="text" placeholder="جستجو" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">نام اولویت</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">وضعیت</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500"><i class="fas fa-gears ml-1"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($ticketPriorities as $key => $ticketPriority)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900">{{ $key + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-700">{{ $ticketPriority->name }}</td>
                                    <td class="px-6 py-4">
                                        @include('admin.components.ui.status-toggle', [
                                            'id' => $ticketPriority->id,
                                            'checked' => $ticketPriority->status == 1,
                                            'url' => route('admin.ticket.priority.status', $ticketPriority->id),
                                            'onChange' => 'changeStatus(' . $ticketPriority->id . ')',
                                        ])
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap items-center justify-center gap-2">
                                            <a href="{{ route('admin.ticket.priority.edit', $ticketPriority->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-4 py-3 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                                <i class="fas fa-pen"></i>
                                                ویرایش
                                            </a>
                                            <form action="{{ route('admin.ticket.priority.destroy', $ticketPriority->id) }}" method="POST" id="delete-form-{{ $ticketPriority->id }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" form="delete-form-{{ $ticketPriority->id }}" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $ticketPriority->id }}">
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
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
