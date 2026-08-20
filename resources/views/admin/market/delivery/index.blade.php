@extends('admin.layouts.master')

@section('head-tag')
    <title>روش های ارسال</title>
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
                    <div>
                        <nav class="mb-3 text-sm text-slate-300">
                            <a href="{{ route('admin.home') }}" class="transition hover:text-white">خانه</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">روش های ارسال</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">روش های ارسال</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">تعریف و مدیریت روش‌های ارسال و زمان تحویل.</p>
                    </div>
                    <a href="{{ route('admin.market.delivery.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-plus text-cyan-700"></i>
                        ایجاد روش ارسال جدید
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">لیست روش های ارسال</h2>
                    <p class="mt-1 text-sm text-slate-500">هر روش ارسال را می‌توانید ویرایش، حذف یا فعال/غیرفعال کنید.</p>
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
                                <th class="px-4 py-3 font-semibold">نام</th>
                                <th class="px-4 py-3 font-semibold">هزینه</th>
                                <th class="px-4 py-3 font-semibold">زمان</th>
                                <th class="px-4 py-3 font-semibold">وضعیت</th>
                                <th class="px-4 py-3 font-semibold">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($deliveries as $delivery)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-4 py-4 font-semibold text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4 font-medium text-slate-900">{{ $delivery->name }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $delivery->amount }} تومان</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $delivery->deliveryTime }}</td>
                                    <td class="px-4 py-4">
                                        <input id="{{ $delivery->id }}" onchange="changeStatus({{ $delivery->id }})" type="checkbox" class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" @checked($delivery->status == 1) data-url="{{ route('admin.market.delivery.status', $delivery->id) }}">
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.market.delivery.edit', $delivery->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                                <i class="fas fa-pen"></i>
                                                ویرایش
                                            </a>
                                            <form action="{{ route('admin.market.delivery.destroy', $delivery->id) }}" method="POST" id="delete-form-{{ $delivery->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $delivery->id }}">
                                                    <i class="fas fa-trash"></i>
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-16 text-center text-slate-500">هنوز روش ارسال ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
