@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="relative isolate overflow-hidden px-6 py-7 sm:px-8">
                <div class="absolute inset-0 -z-10 bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-900"></div>
                <div class="absolute right-0 top-0 -z-10 h-40 w-40 rounded-full bg-cyan-400/20 blur-3xl"></div>
                <div class="absolute bottom-0 left-1/3 -z-10 h-32 w-32 rounded-full bg-fuchsia-400/10 blur-3xl"></div>

                <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <nav class="mb-3 text-sm text-slate-300">
                            <a href="{{ route('admin.home') }}" class="transition hover:text-white">خانه</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <a href="{{ route('admin.content.comment.index') }}" class="transition hover:text-white">نظرات</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">نمایش</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">نمایش نظر</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            جزئیات کامل نظر، نویسنده، پست و پاسخ مدیریتی را از اینجا بررسی کنید.
                        </p>
                    </div>

                    <a href="{{ route('admin.content.comment.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-arrow-right text-cyan-700"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">{{ $comment->author->fullName ?? 'کاربر ناشناس' }}</h2>
                        <p class="mt-1 text-sm text-slate-500">شناسه نویسنده: {{ $comment->author_id }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">{{ $comment->approved_label }}</span>
                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">{{ $comment->seen_label }}</span>
                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">کد نظر: {{ $comment->id }}</span>
                    </div>
                </div>

                <div class="mt-6 rounded-3xl bg-slate-50 p-5">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-cyan-600 shadow-sm">
                            <i class="fas fa-file-lines"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">پست مرتبط</p>
                            <p class="text-xs text-slate-500">{{ $comment->commentable?->title ?? 'بدون عنوان' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 rounded-3xl border border-slate-200 bg-white p-5">
                    <div class="prose prose-slate max-w-none text-sm leading-7 text-slate-700">
                        {!! nl2br(e($comment->body)) !!}
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">پاسخ مدیریتی</p>
                        <p class="mt-1 text-sm text-slate-500">فقط برای کامنت‌های اصلی فعال است.</p>
                    </div>
                    <i class="fas fa-reply text-cyan-600"></i>
                </div>

                @if($comment->parent == null)
                    <form action="{{ route('admin.content.comment.answer', $comment->id) }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label for="body" class="text-sm font-semibold text-slate-700">متن پاسخ</label>
                            <textarea name="body" id="body" rows="8" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                            <i class="fas fa-paper-plane"></i>
                            ثبت پاسخ
                        </button>
                    </form>
                @else
                    <div class="mt-6 rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-5">
                        <p class="text-sm leading-7 text-slate-600">
                            این نظر خودش پاسخ به یک نظر دیگر است و فرم پاسخ مدیریتی برای آن نمایش داده نمی‌شود.
                        </p>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
