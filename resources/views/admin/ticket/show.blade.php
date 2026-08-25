@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش تیکت</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'نمایش تیکت',
            'description' => 'مشاهده جزئیات تیکت و ارسال پاسخ از پنل مدیریت.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'بخش تیکت ها', 'url' => route('admin.ticket.index')],
                ['label' => 'تیکت ها', 'url' => route('admin.ticket.index')],
                ['label' => 'نمایش تیکت'],
            ],
            'actionUrl' => route('admin.ticket.index'),
            'actionLabel' => 'بازگشت',
            'actionIcon' => 'fas fa-arrow-right',
        ])

        <section class="overflow-hidden animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-gradient-to-l from-pink-600 to-rose-500 px-6 py-4 text-white">
                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <span class="font-semibold">{{ $ticket->user->full_name }}</span>
                    <span class="text-sm text-white/80">تیکت #{{ $ticket->id }}</span>
                </div>
            </div>
            <div class="space-y-5 p-6">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">موضوع</p>
                    <h2 class="mt-2 text-xl font-bold text-slate-900">{{ $ticket->subject }}</h2>
                </div>
                <div class="rounded-2xl bg-slate-50 p-5 text-sm leading-8 text-slate-700">
                    {{ $ticket->description }}
                </div>
                @if($ticket->ticketFile)
                    <div>
                        <p class="mb-3 text-sm font-semibold text-slate-700">فایل ارسالی کاربر</p>
                        <img src="{ asset($ticket->ticketFile->file_path) }" class="max-h-96 w-auto max-w-full rounded-2xl border border-slate-200 object-contain shadow-sm" alt="user_send_photo">
                    </div>
                @else
                    <div class="flex items-center gap-3 rounded-2xl border border-cyan-100 bg-cyan-50 px-4 py-3 text-sm text-cyan-700">
                        <i class="fas fa-circle-info"></i>
                        <span>پیام سیستم: هیچ عکسی توسط کاربر ارسال نشده است.</span>
                    </div>
                @endif
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-lg font-bold text-slate-900">پاسخ به تیکت</h2>
                <p class="mt-1 text-sm text-slate-500">پاسخ خود را ثبت کنید تا به عنوان پاسخ ادمین ذخیره شود.</p>
            </div>
            <form action="{{ route('admin.ticket.answer', $ticket->id) }}" method="POST" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label for="answer" class="text-sm font-semibold text-slate-700">پاسخ تیکت</label>
                    <textarea id="answer" name="answer" rows="5" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-100" value="{{ old('answer') }}"></textarea>
                    @include('admin.components.ui.field-error', ['name' => 'answer'])
                </div>
                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-paper-plane"></i>
                        ثبت پاسخ
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
