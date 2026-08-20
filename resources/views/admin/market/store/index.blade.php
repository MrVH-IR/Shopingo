@extends('admin.layouts.master')

@section('head-tag')
    <title>انبار</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
@endsection

@section('content')
    <div class="space-y-6">
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="relative isolate overflow-hidden px-6 py-7 sm:px-8">
                <div class="absolute inset-0 -z-10 bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-900"></div>
                <div class="absolute right-0 top-0 -z-10 h-40 w-40 rounded-full bg-cyan-400/20 blur-3xl"></div>
                <div class="absolute bottom-0 left-1/3 -z-10 h-32 w-32 rounded-full bg-fuchsia-400/10 blur-3xl"></div>
                <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <nav class="mb-3 text-sm text-slate-300">
                            <a href="{{ route('admin.home') }}" class="transition hover:text-white">خانه</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">انبار</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">انبار محصولات</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">موجودی، رزرو شده و مقدار فروخته‌شده هر کالا را مدیریت کنید.</p>
                    </div>
                    <button disabled class="inline-flex cursor-not-allowed items-center gap-2 rounded-2xl bg-white/80 px-4 py-3 text-sm font-semibold text-slate-400">
                        <i class="fas fa-plus"></i>
                        ایجاد انبار جدید
                    </button>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست موجودی کالاها</h2>
                    <p class="mt-1 text-sm text-slate-500">برای هر محصول می‌توانید موجودی اضافه کنید یا مقدار فعلی را اصلاح کنید.</p>
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
                                <th class="px-4 py-3 font-semibold">نام کالا</th>
                                <th class="px-4 py-3 font-semibold">تصویر</th>
                                <th class="px-4 py-3 font-semibold">تعداد قابل فروش</th>
                                <th class="px-4 py-3 font-semibold">رزرو شده</th>
                                <th class="px-4 py-3 font-semibold">فروخته شده</th>
                                <th class="px-4 py-3 font-semibold">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($products as $product)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-4 py-4 font-semibold text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4 font-medium text-slate-900">{{ $product->name }}</td>
                                    <td class="px-4 py-4">
                                        @if(is_array($product->image) && isset($product->image['indexArray'][$product->image['currentImage']]))
                                            <button type="button" class="inline-flex items-center gap-2 text-cyan-700">
                                                <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}" data-large="{{ asset($product->image['indexArray']['large']) }}" alt="{{ $product->name }}" class="preview-img h-16 w-16 rounded-2xl object-cover ring-1 ring-slate-200">
                                            </button>
                                        @else
                                            <span class="text-slate-400">بدون تصویر</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-slate-600">{{ $product->marketable_number }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $product->frozen_number }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $product->sold_out }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.market.store.addToStore', $product->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-3 py-2 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                                <i class="fas fa-plus"></i>
                                                افزایش موجودی
                                            </a>
                                            <a href="{{ route('admin.market.store.edit', $product->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                                <i class="fas fa-pen"></i>
                                                اصلاح موجودی
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-16 text-center text-slate-500">هنوز کالایی برای انبار ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </section>
    </div>

    <div id="imageModal" class="modal-overlay hidden fixed inset-0 z-[70] flex items-center justify-center bg-slate-950/80 px-4">
        <button type="button" class="close-btn absolute left-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-slate-700 shadow-lg" onclick="document.getElementById('imageModal').classList.add('hidden')">
            <i class="fas fa-times"></i>
        </button>
        <img class="modal-content max-h-[85vh] max-w-4xl rounded-3xl object-contain shadow-2xl" id="modalImage" alt="preview">
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
@endsection
