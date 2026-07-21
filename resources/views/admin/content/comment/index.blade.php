@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
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
                            <span class="text-slate-100">نظرات</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">مدیریت نظرات</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            بررسی، تایید و پاسخ‌دادن به نظرات نوشته‌شده برای پست‌ها.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-white backdrop-blur">
                            <p class="text-xs text-slate-300">کل صفحه</p>
                            <p class="mt-1 text-sm font-semibold">نظرات محتوا</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-white backdrop-blur">
                            <p class="text-xs text-slate-300">وضعیت</p>
                            <p class="mt-1 text-sm font-semibold text-emerald-300">فعال</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-white backdrop-blur col-span-2 sm:col-span-1">
                            <p class="text-xs text-slate-300">راهنما</p>
                            <p class="mt-1 text-sm font-semibold">تایید و پاسخ</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست نظرات</h2>
                    <p class="mt-1 text-sm text-slate-500">نظرات جدید به‌صورت پیش‌فرض دیده‌شده علامت می‌خورند تا صف بررسی مرتب بماند.</p>
                </div>

                <div class="w-full max-w-sm">
                    <label for="search" class="sr-only">جستجو</label>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input id="search" type="text" placeholder="جستجو" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                @forelse($comments as $key => $comment)
                    <article class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                            <div class="flex min-w-0 items-start gap-4">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                    <span class="text-sm font-black">{{ $key + 1 }}</span>
                                </div>

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <a href="{{ route('admin.content.comment.show', $comment->id) }}" class="text-base font-bold text-slate-900 transition hover:text-cyan-700">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($comment->body), 80) }}
                                        </a>
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                            {{ $comment->approved_label }}
                                        </span>
                                    </div>

                                    <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-slate-600">
                                        <span class="inline-flex items-center gap-2">
                                            <i class="fas fa-user text-slate-400"></i>
                                            {{ $comment->author->full_name ?? '-' }}
                                        </span>
                                        <span class="inline-flex items-center gap-2">
                                            <i class="fas fa-hashtag text-slate-400"></i>
                                            نویسنده: {{ $comment->author_id }}
                                        </span>
                                        <span class="inline-flex items-center gap-2">
                                            <i class="fas fa-file-lines text-slate-400"></i>
                                            پست: {{ $comment->commentable?->title ?? '-' }}
                                        </span>
                                    </div>

                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @if($comment->parent_id)
                                            <a href="{{ route('admin.content.comment.show', $comment->parent_id) }}" class="inline-flex rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">
                                                پاسخ به: {{ \Illuminate\Support\Str::limit(strip_tags($comment->parent?->body ?? ''), 30) }}
                                            </a>
                                        @else
                                            <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">کامنت اصلی</span>
                                        @endif
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                            کد نظر: {{ $comment->id }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 xl:justify-end">
                                <div class="status-wrapper relative flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3">
                                    <span class="text-xs font-semibold text-slate-500">وضعیت</span>
                                    <input
                                        id="{{ $comment->id }}"
                                        onchange="changeStatus({{ $comment->id }})"
                                        type="checkbox"
                                        class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                                        @checked($comment->status == 1)
                                        data-url="{{ route('admin.content.comment.status', $comment->id) }}"
                                    >
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.content.comment.show', $comment->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-4 py-3 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                        <i class="fas fa-eye"></i>
                                        نمایش
                                    </a>

                                    <form class="hidden" id="approve-{{ $comment->id }}" action="{{ route('admin.content.comment.approved', $comment->id) }}" method="POST">
                                        @csrf
                                    </form>

                                    <button
                                        data-id="{{ $comment->id }}"
                                        type="button"
                                        form="approve-{{ $comment->id }}"
                                        title="{{ $comment->approved ? 'این کامنت تایید شده است' : 'این کامنت هنوز تایید نشده' }}"
                                        class="toggle-approve inline-flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold transition {{ $comment->approved ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}"
                                    >
                                        <i class="fas {{ $comment->approved ? 'fa-check' : 'fa-clock' }}"></i>
                                        <span>{{ $comment->approved ? 'تایید شده' : 'تایید نشده' }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm">
                            <i class="fas fa-comments text-xl"></i>
                        </div>
                        <h3 class="mt-4 text-base font-bold text-slate-900">هنوز نظری ثبت نشده</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">وقتی کاربران نظر ارسال کنند، اینجا برای بررسی نمایش داده می‌شود.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4">
                {{ $comments->links() }}
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/toggleApprove.js') }}"></script>
@endsection
