@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش روش ارسال</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.delivery.index') }}" class="hover:text-slate-900">روش های ارسال</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">ویرایش</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">ویرایش روش ارسال</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">اطلاعات روش ارسال را اصلاح کنید و وضعیت آن را به‌روز نگه دارید.</p>
                </div>

                <a href="{{ route('admin.market.delivery.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.delivery.update', $delivery->id) }}" method="POST" class="space-y-6">
                @method('PUT')
                @csrf

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold text-slate-700">نام روش ارسال</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $delivery->name) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('name')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="amount" class="text-sm font-semibold text-slate-700">هزینه روش ارسال</label>
                        <input type="text" name="amount" id="amount" value="{{ old('amount', $delivery->amount) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('amount')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="delivery_time" class="text-sm font-semibold text-slate-700">مقدار زمان ارسال</label>
                        <input type="text" name="delivery_time" id="delivery_time" value="{{ old('delivery_time', $delivery->getRawOriginal('delivery_time')) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('delivery_time')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="delivery_time_unit" class="text-sm font-semibold text-slate-700">نوع زمان ارسال</label>
                        <input type="text" name="delivery_time_unit" id="delivery_time_unit" value="{{ old('delivery_time_unit', $delivery->delivery_time_unit) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                        @error('delivery_time_unit')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="status" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status', $delivery->status) == 0)>غیر فعال</option>
                            <option value="1" @selected(old('status', $delivery->status) == 1)>فعال</option>
                        </select>
                        @error('status')
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
