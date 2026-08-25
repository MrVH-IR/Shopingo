@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'تیکت ها',
            'description' => 'مدیریت تیکت‌های کاربران، وضعیت و ارجاعات آن‌ها.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'بخش تیکت ها', 'url' => route('admin.ticket.index')],
                ['label' => 'تیکت ها'],
            ],
            'actionLabel' => 'ایجاد تیکت',
            'actionDisabled' => true,
            'actionIcon' => 'fas fa-plus',
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست تیکت ها</h2>
                    <p class="mt-1 text-sm text-slate-500">برای مشاهده جزئیات و پاسخ‌گویی، روی مشاهده کلیک کنید.</p>
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
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">#</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">نویسنده تیکت</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">عنوان تیکت</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">دسته تیکت</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">اولویت تیکت</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">ارجاع شده از</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">تیکت والد</th>
                                <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($tickets as $ticket)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-5 py-4 text-sm font-semibold text-slate-900">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $ticket->user?->full_name }}</td>
                                    <td class="max-w-xs px-5 py-4 text-sm font-medium text-slate-700">{{ $ticket->subject }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $ticket->category?->name }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $ticket->priority?->name }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $ticket->admin?->user?->full_name }}</td>
                                    <td class="max-w-xs px-5 py-4 text-sm text-slate-600">{{ $ticket->parent?->subject ?? '-' }}</td>
                                    <td class="px-5 py-4">
                                        <div class="flex flex-wrap items-center justify-center gap-2">
                                            <a href="{{ route('admin.ticket.show', $ticket->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-3 py-2 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                                <i class="fas fa-eye"></i>
                                                مشاهده
                                            </a>
                                            <a href="{{ route('admin.ticket.change', $ticket->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                                <i class="fas fa-check"></i>
                                                {{ $ticket->status == 1 ? 'بستن' : 'باز کردن' }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4">{{ $tickets->links() }}</div>
        </section>
    </div>
@endsection
