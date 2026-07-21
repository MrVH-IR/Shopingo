@extends('admin.layouts.master')

@section('head-tag')
    <title>داشبورد اصلی</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="relative isolate px-6 py-8 sm:px-8 lg:px-10">
                <div class="absolute inset-0 -z-10 bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-900"></div>
                <div class="absolute inset-y-0 right-0 -z-10 w-1/2 bg-gradient-to-l from-cyan-500/20 to-transparent"></div>
                <div class="absolute -left-10 top-0 -z-10 h-40 w-40 rounded-full bg-cyan-400/20 blur-3xl"></div>
                <div class="absolute bottom-0 right-1/4 -z-10 h-32 w-32 rounded-full bg-fuchsia-400/10 blur-3xl"></div>

                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs font-semibold text-cyan-100">
                            <i class="fas fa-sparkles"></i>
                            داشبورد مدیریت
                        </span>
                        <h1 class="mt-4 text-3xl font-black tracking-tight text-white sm:text-4xl">
                            خوش آمدید، اینجا مرکز کنترل فروشگاه است
                        </h1>
                        <p class="mt-3 max-w-xl text-sm leading-7 text-slate-300 sm:text-base">
                            یک نمای سریع از وضعیت درآمد، سفارش‌ها، کاربران و فعالیت‌های مهم را همین‌جا ببینید.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-white backdrop-blur">
                            <p class="text-xs text-slate-300">آخرین بروزرسانی</p>
                            <p class="mt-1 text-sm font-semibold">21:42</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-white backdrop-blur">
                            <p class="text-xs text-slate-300">وضعیت</p>
                            <p class="mt-1 text-sm font-semibold text-emerald-300">فعال</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 text-white backdrop-blur col-span-2 sm:col-span-1">
                            <p class="text-xs text-slate-300">مورد توجه</p>
                            <p class="mt-1 text-sm font-semibold">رشد فروش امروز</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($stats as $stat)
                <div class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start justify-between gap-4 p-5">
                        <div>
                            <p class="text-sm font-medium text-slate-500">{{ $stat['title'] }}</p>
                            <p class="mt-3 text-2xl font-black tracking-tight text-slate-900">{{ $stat['value'] }}</p>
                            @if(! is_null($stat['delta']))
                                <span class="mt-3 inline-flex items-center gap-1 rounded-full {{ $stat['bg'] }} px-2.5 py-1 text-xs font-semibold {{ $stat['text'] }}">
                                    <i class="fas {{ ($stat['delta_value'] ?? 0) < 0 ? 'fa-arrow-trend-down' : 'fa-arrow-trend-up' }} text-[11px]"></i>
                                    {{ $stat['delta'] }}
                                </span>
                            @endif
                        </div>

                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br {{ $stat['accent'] }} text-white shadow-lg shadow-slate-200">
                            <i class="{{ $stat['icon'] }} text-xl"></i>
                        </div>
                    </div>

                    <div class="h-1 w-full bg-slate-100">
                        <div class="h-1 w-3/4 bg-gradient-to-r {{ $stat['accent'] }}"></div>
                    </div>
                </div>
            @endforeach
        </section>

        <section class="grid gap-6 xl:grid-cols-3">
            <div class="xl:col-span-2 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">خلاصه فعالیت‌ها</p>
                        <p class="mt-1 text-sm text-slate-500">نمایی تمیز از وضعیت سیستم در این لحظه</p>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">Live</span>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-50 p-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-cyan-600 shadow-sm">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">نرخ تبدیل</p>
                                <p class="text-xs text-slate-500">نسبت بازدید به خرید</p>
                            </div>
                        </div>
                        <div class="mt-5 h-2 overflow-hidden rounded-full bg-slate-200">
                            <div class="h-full w-[68%] rounded-full bg-gradient-to-r from-cyan-500 to-blue-500"></div>
                        </div>
                        <p class="mt-3 text-sm text-slate-600">68% در این هفته</p>
                    </div>

                    <div class="rounded-3xl bg-slate-50 p-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow-sm">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">زمان پاسخ</p>
                                <p class="text-xs text-slate-500">میانگین رسیدگی</p>
                            </div>
                        </div>
                        <div class="mt-5 h-2 overflow-hidden rounded-full bg-slate-200">
                            <div class="h-full w-[84%] rounded-full bg-gradient-to-r from-emerald-500 to-teal-500"></div>
                        </div>
                        <p class="mt-3 text-sm text-slate-600">84% وضعیت مطلوب</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">اقدام سریع</p>
                        <p class="mt-1 text-sm text-slate-500">دسترسی‌های پرکاربرد</p>
                    </div>
                    <i class="fas fa-bolt text-amber-500"></i>
                </div>

                <div class="mt-6 space-y-3">
                    <a href="{{ route('admin.market.product.index') }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 transition hover:bg-slate-100">
                        <span class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                                <i class="fas fa-box"></i>
                            </span>
                            <span class="text-sm font-medium text-slate-700">مدیریت کالاها</span>
                        </span>
                        <i class="fas fa-chevron-left text-xs text-slate-400"></i>
                    </a>

                    <a href="{{ route('admin.market.order.all') }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 transition hover:bg-slate-100">
                        <span class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <i class="fas fa-receipt"></i>
                            </span>
                            <span class="text-sm font-medium text-slate-700">همه سفارشات</span>
                        </span>
                        <i class="fas fa-chevron-left text-xs text-slate-400"></i>
                    </a>

                    <a href="{{ route('admin.user.customer.index') }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 transition hover:bg-slate-100">
                        <span class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-fuchsia-50 text-fuchsia-600">
                                <i class="fas fa-users"></i>
                            </span>
                            <span class="text-sm font-medium text-slate-700">مشتریان</span>
                        </span>
                        <i class="fas fa-chevron-left text-xs text-slate-400"></i>
                    </a>
                </div>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">بخش کاربران</p>
                        <p class="mt-1 text-sm text-slate-500">جایگاه خوبی برای آمار واقعی کاربران</p>
                    </div>
                    <span class="rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">در حال توسعه</span>
                </div>

                <div class="mt-6 rounded-3xl border border-dashed border-slate-200 bg-slate-50 p-6">
                    <p class="text-sm leading-7 text-slate-600">
                        این بخش فعلاً برای محتوای تحلیلی آینده آماده شده است. می‌توانیم بعداً نمودارها، آخرین فعالیت‌ها، وضعیت سفارش‌ها و هشدارهای مدیریتی را اینجا اضافه کنیم.
                    </p>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">یادداشت سریع</p>
                        <p class="mt-1 text-sm text-slate-500">برای نمایش وضعیت‌های مهم مدیریتی</p>
                    </div>
                    <i class="fas fa-sticky-note text-slate-400"></i>
                </div>

                <div class="mt-6 space-y-3">
                    <div class="flex items-start gap-3 rounded-2xl bg-amber-50 px-4 py-3">
                        <i class="fas fa-circle-info mt-1 text-amber-500"></i>
                        <p class="text-sm leading-6 text-amber-800">شما می‌توانید این کارت‌ها را بعداً به داده‌های واقعی وصل کنید.</p>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-sky-50 px-4 py-3">
                        <i class="fas fa-palette mt-1 text-sky-500"></i>
                        <p class="text-sm leading-6 text-sky-800">الان ساختار اصلی تمیز و مدرن است و برای توسعه‌های بعدی آماده‌تر شده.</p>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-emerald-50 px-4 py-3">
                        <i class="fas fa-check-circle mt-1 text-emerald-500"></i>
                        <p class="text-sm leading-6 text-emerald-800">بدون تغییر در منطق بک‌اند، فقط UI/UX به‌روز شده است.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
