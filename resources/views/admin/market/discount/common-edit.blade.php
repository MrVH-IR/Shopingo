@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ویرایش تخفیف عمومی</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.category.index') }}" class="hover:text-slate-900">بخش فروش</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.discount.commonDiscount') }}" class="hover:text-slate-900">تخفیف عمومی</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">ویرایش</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">ویرایش تخفیف عمومی</h1>
                </div>
                <a href="{{ route('admin.market.discount.commonDiscount') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700"><i class="fas fa-arrow-right"></i> بازگشت</a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.discount.commonDiscount.update', $commonDiscount->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="discount" class="text-sm font-semibold text-slate-700">درصد تخفیف</label>
                        <input type="text" name="discount" id="discount" value="{{ old('discount', $commonDiscount->discount) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    </div>
                    <div class="space-y-2">
                        <label for="discount_ceiling" class="text-sm font-semibold text-slate-700">حداکثر تخفیف</label>
                        <input type="text" name="discount_ceiling" id="discount_ceiling" value="{{ old('discount_ceiling', $commonDiscount->discount_ceiling) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    </div>
                    <div class="space-y-2">
                        <label for="discount_floor" class="text-sm font-semibold text-slate-700">حداقل مبلغ خرید</label>
                        <input type="text" name="discount_floor" id="discount_floor" value="{{ old('discount_floor', $commonDiscount->discount_floor) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    </div>
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-semibold text-slate-700">عنوان مناسبت</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $commonDiscount->title) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    </div>
                    <div class="space-y-2">
                        <label for="start_date" class="text-sm font-semibold text-slate-700">تاریخ شروع</label>
                        <input type="text" id="start_date" name="start_date" value="{{ old('start_date', \Morilog\Jalali\Jalalian::fromCarbon($commonDiscount->start_at)->format('Y/m/d H:i:s')) }}" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    </div>
                    <div class="space-y-2">
                        <label for="end_date" class="text-sm font-semibold text-slate-700">تاریخ پایان</label>
                        <input type="text" id="end_date" name="end_date" value="{{ old('end_date', \Morilog\Jalali\Jalalian::fromCarbon($commonDiscount->end_at)->format('Y/m/d H:i:s')) }}" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    </div>
                    <div class="space-y-2 lg:col-span-2">
                        <label for="status" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="">انتخاب کنید</option>
                            <option value="0" @selected(old('status', $commonDiscount->status) == 0)>غیرفعال</option>
                            <option value="1" @selected(old('status', $commonDiscount->status) == 1)>فعال</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">ثبت</button>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
@endsection
