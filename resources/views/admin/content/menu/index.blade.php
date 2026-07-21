@extends('admin.layouts.master')

@section('head-tag')
    <title>منو</title>
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
                            <span class="text-slate-100">منو</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">منوها</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            ساخت و مدیریت منوهای اصلی و زیرمنوها با یک نمای سبک و مدرن.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.content.menu.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                            <i class="fas fa-plus text-cyan-700"></i>
                            ایجاد منوی جدید
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست منوها</h2>
                    <p class="mt-1 text-sm text-slate-500">هر منو به صورت یک کارت فشرده نمایش داده می‌شود.</p>
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
                @forelse($menus as $key => $menu)
                    <article class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                            <div class="flex min-w-0 items-start gap-4">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                    <span class="text-sm font-black">{{ $key + 1 }}</span>
                                </div>

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h3 class="text-base font-bold text-slate-900">{{ $menu->name }}</h3>
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                            {{ $menu->parent_id ? $menu->parent?->name : 'منو اصلی' }}
                                        </span>
                                    </div>

                                    <div class="mt-2 flex flex-wrap items-center gap-2 text-sm text-slate-600">
                                        <span class="inline-flex items-center gap-2 rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">
                                            <i class="fas fa-link"></i>
                                            {{ config('app.url') . '/' . $menu->url }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 xl:justify-end">
                                <div class="status-wrapper relative flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3">
                                    <span class="text-xs font-semibold text-slate-500">وضعیت</span>
                                    <input
                                        id="{{ $menu->id }}"
                                        onchange="changeStatus({{ $menu->id }})"
                                        type="checkbox"
                                        class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                                        @checked($menu->status == 1)
                                        data-url="{{ route('admin.content.menu.status', $menu->id) }}"
                                    >
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.content.menu.edit', $menu->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                        <i class="fas fa-pen"></i>
                                        ویرایش
                                    </a>

                                    <form action="{{ route('admin.content.menu.destroy', $menu->id) }}" method="POST" id="delete-form-{{ $menu->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $menu->id }}">
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
                            <i class="fas fa-bars text-xl"></i>
                        </div>
                        <h3 class="mt-4 text-base font-bold text-slate-900">هنوز منویی ثبت نشده</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">اولین منوی سایت را بسازید تا اینجا نمایش داده شود.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4">
                {{ $menus->links() }}
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
