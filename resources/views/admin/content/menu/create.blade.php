@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد منو</title>
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
                            <a href="{{ route('admin.content.menu.index') }}" class="transition hover:text-white">منو</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">ایجاد</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">ایجاد منو</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            یک منوی جدید یا زیرمنو برای ناوبری سایت بسازید.
                        </p>
                    </div>

                    <a href="{{ route('admin.content.menu.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-arrow-right text-cyan-700"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form id="form" action="{{ route('admin.content.menu.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-slate-700">عنوان منو</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="مثلاً: تماس با ما" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">
                        @error('name')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="parent_id" class="text-sm font-semibold text-slate-700">منو والد</label>
                        <select name="parent_id" id="parent_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="">منو اصلی</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" @selected(old('parent_id') == $menu->id)>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="url" class="text-sm font-semibold text-slate-700">آدرس URL</label>
                        <input
                            type="text"
                            name="url"
                            id="url"
                            value="{{ old('url') }}"
                            placeholder="مثلاً: contact-us"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white"
                        >
                        <p class="text-xs leading-6 text-slate-500">
                            آدرس را ساده و لاتین وارد کنید. مثال: `contact-us`
                        </p>
                        @error('url')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status') == 0)>غیر فعال</option>
                            <option value="1" @selected(old('status') == 1)>فعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت منو
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
