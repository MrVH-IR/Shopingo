@extends('admin.layouts.master')

@section('head-tag')
    <title>اضافه کردن به انبار</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.store.index') }}" class="hover:text-slate-900">انبار</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">افزودن موجودی</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">افزودن موجودی به انبار</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">یک ورودی انبار جدید برای ثبت تحویل، تعداد و توضیحات اضافه کنید.</p>
                </div>

                <a href="{{ route('admin.market.store.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.store.store', $product->id) }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="receiver" class="text-sm font-semibold text-slate-700">نام تحویل گیرنده</label>
                        <input type="text" name="receiver" id="receiver" value="{{ old('receiver') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('receiver')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="deliverer" class="text-sm font-semibold text-slate-700">نام تحویل دهنده</label>
                        <input type="text" name="deliverer" id="deliverer" value="{{ old('deliverer') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('deliverer')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="marketable_number" class="text-sm font-semibold text-slate-700">تعداد</label>
                        <input type="text" name="marketable_number" id="marketable_number" value="{{ old('marketable_number') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('marketable_number')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="description" class="text-sm font-semibold text-slate-700">توضیحات</label>
                        <textarea name="description" id="description" rows="5" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-7 text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
