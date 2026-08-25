<header class="print:hidden sticky top-0 z-40 border-b border-slate-800/80 bg-slate-950/95 text-white shadow-lg shadow-slate-950/10 backdrop-blur-xl">
    <div class="mx-auto flex h-20 max-w-[1600px] items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-2 sm:gap-3">
            <button
                id="sidebar-toggle-show"
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 transition hover:border-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-200 lg:hidden"
                x-on:click="sidebarOpen = true; sidebarCollapsed = false"
                aria-label="باز کردن منو"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

            <button
                id="sidebar-toggle-hide"
                type="button"
                class="hidden h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 transition hover:border-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-200 lg:inline-flex"
                x-on:click="sidebarCollapsed = !sidebarCollapsed"
                aria-label="تغییر وضعیت سایدبار"
            >
                <i class="fa-solid text-sm" x-bind:class="sidebarCollapsed ? 'fa-angles-left' : 'fa-sidebar'"></i>
            </button>

            <a href="{{ route('admin.home') }}" class="flex min-w-0 items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-3 py-2 transition hover:border-white/20 hover:bg-white/10">
                <img class="h-10 w-10 rounded-xl object-cover" src="{{ asset('admin-assets/images/shopingo_logo-3.png') }}" alt="Shopingo">
                <span class="hidden truncate text-sm font-bold tracking-wide sm:inline">Shopingo Admin</span>
            </a>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <div class="hidden items-center gap-2 md:flex">
                <div id="search-area" class="hidden items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-3 py-2">
                    <button id="search-area-hide" type="button" class="text-slate-400 transition hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                    <input id="search-input" type="text" class="w-0 bg-transparent text-sm text-white outline-none placeholder:text-slate-500" placeholder="جستجو...">
                    <button type="button" class="text-slate-400 transition hover:text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <button id="search-toggle" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 transition hover:border-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-200">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <button id="full-screen" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 transition hover:border-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-200">
                    <i id="screen-compress" class="fa-solid fa-compress hidden"></i>
                    <i id="screen-expand" class="fa-solid fa-expand"></i>
                </button>
            </div>

            @php
                $unreadNotificationsCount = $notifications->whereNull('read_at')->count();
            @endphp

            <div class="relative" x-data="{ open: false }">
                <button id="header-notification-toggle" type="button" class="relative inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 transition hover:border-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-200" x-on:click="open = !open">
                    <i class="fa-regular fa-bell"></i>
                    @if($unreadNotificationsCount !== 0)
                        <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white ring-2 ring-slate-950">
                            {{ $unreadNotificationsCount }}
                        </span>
                    @endif
                </button>

                <section id="header-notification" x-show="open" x-transition.origin.top.left.duration.150ms @click.outside="open = false" class="absolute left-0 mt-3 w-[22rem] overflow-hidden rounded-3xl border border-slate-200 bg-white text-slate-900 shadow-2xl shadow-slate-950/20">
                    <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-700">نوتیفیکیشن ها</span>
                        @if($unreadNotificationsCount !== 0)
                            <span class="rounded-full bg-rose-50 px-2 py-1 text-[11px] font-bold text-rose-600">{{ $unreadNotificationsCount }} جدید</span>
                        @endif
                    </div>
                    <ul class="max-h-80 divide-y divide-slate-100 overflow-y-auto">
                        @forelse($notifications as $notification)
                            <li class="px-4 py-3 transition hover:bg-slate-50">
                                <div class="flex gap-3">
                                    <img class="h-10 w-10 rounded-2xl object-cover" src="{{ asset('admin-assets/images/avatar-3.jpg') }}" alt="avatar">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-slate-700">اعلان سیستم</p>
                                        <p class="mt-1 text-sm leading-6 text-slate-500">{{ $notification['data']['message'] }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-10 text-center text-sm text-slate-400">اعلانی وجود ندارد.</li>
                        @endforelse
                    </ul>
                </section>
            </div>

            <div class="relative" x-data="{ open: false }">
                <button id="header-comment-toggle" type="button" class="relative inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 transition hover:border-cyan-400/20 hover:bg-cyan-400/10 hover:text-cyan-200" x-on:click="open = !open">
                    <i class="fa-regular fa-comment"></i>
                    @if($unSeenComment->count() !== 0)
                        <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white ring-2 ring-slate-950">{{ $unSeenComment->count() }}</span>
                    @endif
                </button>

                <section id="header-comment" x-show="open" x-transition.origin.top.left.duration.150ms @click.outside="open = false" class="absolute left-0 mt-3 w-[28rem] max-w-[calc(100vw-2rem)] overflow-hidden rounded-3xl border border-slate-200 bg-white text-slate-900 shadow-2xl shadow-slate-950/20">
                    <div class="border-b border-slate-100 px-4 py-4">
                        <div class="rounded-2xl bg-slate-50 px-3 py-2.5">
                            <input type="text" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400" placeholder="جستجو ...">
                        </div>
                    </div>
                    <div class="max-h-80 overflow-y-auto">
                        <ul class="divide-y divide-slate-100">
                            @forelse($unSeenComment as $Comment)
                                <li class="px-4 py-3 transition hover:bg-slate-50">
                                    <div class="flex gap-3">
                                        <img src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="avatar" class="h-10 w-10 rounded-2xl object-cover">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-start justify-between gap-3">
                                                <h5 class="text-sm font-bold text-slate-700">{{ $Comment->author->fullName }}</h5>
                                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                                            </div>
                                            <p class="mt-1 text-sm leading-6 text-slate-500">{{ $Comment->body }}</p>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="px-4 py-10 text-center text-sm text-slate-400">نظر جدیدی وجود ندارد.</li>
                            @endforelse
                        </ul>
                    </div>
                </section>
            </div>

            <div class="relative" x-data="{ open: false }">
                <button id="header-profile-toggle" type="button" class="flex h-10 items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-2.5 text-left transition hover:border-cyan-400/20 hover:bg-cyan-400/10" x-on:click="open = !open">
                    <img class="h-8 w-8 rounded-xl object-cover ring-1 ring-white/20" src="{{ asset(auth()->user()->profile_photo_path ?? 'admin-assets/images/avatar-2.jpg') }}" alt="">
                    <span class="hidden max-w-40 truncate text-xs font-semibold text-white sm:inline">{{ auth()->user()->full_name ?? auth()->user()->email ?? auth()->user()->mobile ?? '-' }}</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform" x-bind:class="open ? 'rotate-180 text-cyan-300' : ''"></i>
                </button>

                <section id="header-profile" x-show="open" x-transition.origin.top.left.duration.150ms @click.outside="open = false" class="absolute left-0 mt-3 w-64 overflow-hidden rounded-3xl border border-slate-200 bg-white text-slate-900 shadow-2xl shadow-slate-950/20">
                    <div class="border-b border-slate-100 bg-slate-50 px-4 py-4">
                        <p class="truncate text-sm font-bold text-slate-800">{{ auth()->user()->full_name ?? auth()->user()->email ?? auth()->user()->mobile ?? '-' }}</p>
                        <p class="mt-1 text-xs text-slate-400">پنل مدیریت</p>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('admin.setting.index') }}" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"><i class="fa-solid fa-sliders w-5 text-slate-400"></i><span>تنظیمات</span></a>
                        <a href="{{ route('admin.user.admin-user.index') }}" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"><i class="fa-solid fa-user w-5 text-slate-400"></i><span>کاربر</span></a>
                        <button form="lock_form" class="flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"><i class="fa-solid fa-lock w-5 text-slate-400"></i><span>قفل صفحه</span></button>
                        <button form="logout_form" class="flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-rose-600 transition hover:bg-rose-50"><i class="fa-solid fa-arrow-right-from-bracket w-5 text-rose-500"></i><span>خروج</span></button>
                    </div>
                </section>
            </div>
        </div>
    </div>
</header>

<form class="hidden" action="{{ route('auth.customer.logout') }}" method="POST" id="logout_form">@csrf</form>
<form action="{{ route('lock-screen.lock') }}" method="POST" class="hidden" id="lock_form">@csrf</form>
