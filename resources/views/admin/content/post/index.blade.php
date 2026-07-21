@extends('admin.layouts.master')

@section('head-tag')
    <title>پست‌ها</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
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
                            <span class="text-slate-100">پست‌ها</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">پست‌ها</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            مدیریت مقالات، تصویر اصلی، دسته‌بندی، انتشار و درج کامنت.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.content.post.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                            <i class="fas fa-plus text-cyan-700"></i>
                            ایجاد پست جدید
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست پست‌ها</h2>
                    <p class="mt-1 text-sm text-slate-500">هر پست به صورت یک کارت فشرده و خوانا نمایش داده می‌شود.</p>
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
                @forelse($posts as $key => $post)
                    <article class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                            <div class="flex min-w-0 items-start gap-4">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                    <span class="text-sm font-black">{{ $key + 1 }}</span>
                                </div>

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h3 class="text-base font-bold text-slate-900">{{ $post->title }}</h3>
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                            {{ $post->category?->name ?? 'بدون دسته' }}
                                        </span>
                                    </div>

                                    <div class="mt-2 flex flex-wrap items-center gap-2 text-sm text-slate-600">
                                        <span class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">
                                            <i class="fas fa-calendar"></i>
                                            {{ $post->published_at ?? '-' }}
                                        </span>
                                        <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                            {{ $post->slug }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 xl:justify-end">
                                <div class="flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3">
                                    @if(isset($post->image['indexArray'][$post->image['currentImage']]))
                                        <button type="button" class="group inline-flex items-center gap-3 text-right">
                                            <img
                                                src="{{ asset($post->image['indexArray'][$post->image['currentImage']]) }}"
                                                data-large="{{ asset($post->image['indexArray']['large']) }}"
                                                alt="{{ $post->title }}"
                                                class="preview-img h-12 w-12 rounded-2xl object-cover ring-1 ring-slate-200"
                                            >
                                            <span class="text-xs font-semibold text-cyan-700 group-hover:text-cyan-900">تصویر</span>
                                        </button>
                                    @else
                                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-200 text-slate-500">
                                            <i class="fas fa-image"></i>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-500">بدون تصویر</span>
                                    @endif
                                </div>

                                <div class="status-wrapper relative flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3">
                                    <span class="text-xs font-semibold text-slate-500">وضعیت</span>
                                    <input
                                        id="status-{{ $post->id }}"
                                        onchange="changeStatus('status-{{ $post->id }}')"
                                        type="checkbox"
                                        class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                                        @checked($post->status == 1)
                                        data-url="{{ route('admin.content.post.status', $post->id) }}"
                                    >
                                </div>

                                <div class="status-wrapper relative flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3">
                                    <span class="text-xs font-semibold text-slate-500">کامنت</span>
                                    <input
                                        id="commentable-{{ $post->id }}"
                                        onchange="changeStatus('commentable-{{ $post->id }}')"
                                        type="checkbox"
                                        class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                                        @checked($post->commentable == 1)
                                        data-url="{{ route('admin.content.post.commentable', $post->id) }}"
                                    >
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.content.post.edit', $post->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                        <i class="fas fa-pen"></i>
                                        ویرایش
                                    </a>

                                    <form action="{{ route('admin.content.post.destroy', $post->id) }}" method="POST" id="delete-form-{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $post->id }}">
                                            <i class="fas fa-trash"></i>
                                            حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm">
                            <i class="fas fa-newspaper text-xl"></i>
                        </div>
                        <h3 class="mt-4 text-base font-bold text-slate-900">هنوز پستی ثبت نشده</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">اولین مقاله را بسازید تا اینجا نمایش داده شود.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4">
                {{ $posts->links() }}
            </div>
        </section>

        <div id="imageModal" class="modal-overlay fixed inset-0 z-[70] flex items-center justify-center bg-slate-950/80 px-4">
            <button type="button" class="close-btn absolute left-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-slate-700 shadow-lg">
                <i class="fas fa-times"></i>
            </button>
            <img class="modal-content max-h-[85vh] max-w-4xl rounded-3xl object-contain shadow-2xl" id="modalImage" alt="preview">
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
