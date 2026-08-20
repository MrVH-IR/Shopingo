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
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">نظرات کاربران</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">مدیریت و بررسی نظرهای ثبت‌شده برای محتوا و محصولات.</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button disabled class="inline-flex cursor-not-allowed items-center gap-2 rounded-2xl bg-white/80 px-4 py-3 text-sm font-semibold text-slate-400">
                            <i class="fas fa-plus"></i>
                            ایجاد نظر جدید
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">لیست نظرات</h2>
                    <p class="mt-1 text-sm text-slate-500">از این بخش می‌توانید نظرها را بررسی، تایید یا وارد صفحه جزئیات شوید.</p>
                </div>

                <div class="w-full max-w-sm">
                    <label for="search" class="sr-only">جستجو</label>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input id="search" type="text" placeholder="جستجو" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-right text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 font-semibold">#</th>
                                <th class="px-4 py-3 font-semibold">نظر</th>
                                <th class="px-4 py-3 font-semibold">نویسنده</th>
                                <th class="px-4 py-3 font-semibold">پاسخ به</th>
                                <th class="px-4 py-3 font-semibold">کد کاربر</th>
                                <th class="px-4 py-3 font-semibold">کد پست</th>
                                <th class="px-4 py-3 font-semibold">پست</th>
                                <th class="px-4 py-3 font-semibold">تایید</th>
                                <th class="px-4 py-3 font-semibold">وضعیت</th>
                                <th class="px-4 py-3 font-semibold">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($comments as $comment)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-4 py-4 font-semibold text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4">
                                        <a href="{{ route('admin.market.comment.show', $comment->id) }}" class="line-clamp-1 font-medium text-slate-900 hover:text-cyan-700">
                                            {{ \Illuminate\Support\Str::limit($comment->body, 40) }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-slate-600">{{ $comment->author?->full_name }}</td>
                                    <td class="px-4 py-4 text-slate-600">
                                        @if($comment->parent_id)
                                            <a href="{{ route('admin.market.comment.show', $comment->parent_id) }}" class="hover:text-cyan-700">
                                                {{ \Illuminate\Support\Str::limit($comment->parent?->body, 30) }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-slate-500">{{ $comment->author_id }}</td>
                                    <td class="px-4 py-4 text-slate-500">{{ $comment->commentable_id }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $comment->commentable?->title }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">{{ $comment->approved_label }}</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="status-wrapper relative inline-flex">
                                            <input id="{{ $comment->id }}" onchange="changeStatus({{ $comment->id }})" type="checkbox" class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" @checked($comment->status == 1) data-url="{{ route('admin.market.comment.status', $comment->id) }}">
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.market.comment.show', $comment->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-3 py-2 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                                <i class="fas fa-eye"></i>
                                                نمایش
                                            </a>
                                            <form class="hidden" id="approve-{{ $comment->id }}" action="{{ route('admin.market.comment.approved', $comment->id) }}" method="POST">
                                                @csrf
                                            </form>
                                            <button data-id="{{ $comment->id }}" type="button" form="approve-{{ $comment->id }}" title="{{ $comment->approved ? 'این کامنت تایید شده است' : 'این کامنت هنوز تایید نشده' }}" class="toggle-approve inline-flex items-center gap-2 rounded-2xl px-3 py-2 text-sm font-semibold transition {{ $comment->approved ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">
                                                <i class="fas {{ $comment->approved ? 'fa-check' : 'fa-clock' }}"></i>
                                                {{ $comment->approved ? 'تایید شده' : 'تایید نشده' }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-4 py-16 text-center text-slate-500">هنوز نظری ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $comments->links() }}
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/toggleApprove.js') }}"></script>
@endsection
