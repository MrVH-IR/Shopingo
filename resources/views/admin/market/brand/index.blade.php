@extends('admin.layouts.master')

@section('head-tag')
<title>برند</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/status.css') }}">
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
                    <div class="max-w-2xl">
                        <nav class="mb-3 text-sm text-slate-300">
                            <a href="{{ route('admin.home') }}" class="transition hover:text-white">خانه</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <a href="#" class="transition hover:text-white">بخش فروش</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">برند ها</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">برندها</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            مدیریت برندهای فروش با اسم اصلی، تصویر، تگ‌ها و وضعیت.
                        </p>
                    </div>

                    <a href="{{ route('admin.market.brand.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-plus text-cyan-700"></i>
                        ایجاد برند
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">فهرست برندها</h2>
                    <p class="mt-1 text-sm text-slate-500">برندها به صورت یک کارت فشرده نمایش داده می‌شوند.</p>
                </div>

                <div class="w-full max-w-sm">
                    <label for="search" class="sr-only">جستجو</label>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input id="search" type="text" placeholder="جستجو" name="search" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">نام برند</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">تصویر برند</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">تگ ها</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">وضعیت</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($brands as $brand)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $brand->original_name }}</td>
                                <td class="px-6 py-4">
                                    @if(is_array($brand->image) && isset($brand->image['indexArray'][$brand->image['currentImage']]))
                                        <button type="button" class="group inline-flex items-center gap-3 text-right">
                                            <img
                                                src="{{ asset($brand->image['indexArray'][$brand->image['currentImage']]) }}"
                                                data-large="{{ asset($brand->image['indexArray']['large']) }}"
                                                alt="{{ $brand->name }}"
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
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $brand->tags }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="status-wrapper relative inline-flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3">
                                        <span class="text-xs font-semibold text-slate-500">وضعیت</span>
                                        <input
                                            id="{{ $brand->id }}"
                                            onchange="changeStatus({{ $brand->id }})"
                                            type="checkbox"
                                            @if($brand->status == 1) checked @endif
                                            data-url="{{ route('admin.market.brand.status', $brand->id) }}"
                                            class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.market.brand.edit' , $brand->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-4 py-3 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                            <i class="fas fa-pen"></i>
                                            ویرایش
                                        </a>
                                        <form action="{{ route('admin.market.brand.destroy' , $brand->id) }}" method="POST" id="delete-form-{{ $brand->id }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $brand->id }}">
                                                <i class="fas fa-trash"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4">
                {{ $brands->links() }}
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
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
