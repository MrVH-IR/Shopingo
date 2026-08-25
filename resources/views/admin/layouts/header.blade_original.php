<header class="print:hidden sticky top-0 z-40 border-b border-slate-200 bg-slate-950/95 text-white shadow-lg shadow-slate-900/10 backdrop-blur">
    <div class="mx-auto flex h-20 max-w-[100vw] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <button id="sidebar-toggle-show" type="button" class="hidden rounded-2xl border border-white/10 bg-white/5 p-2 text-slate-100 transition hover:bg-white/10">
                <i class="fas fa-toggle-on text-lg"></i>
            </button>
            <button id="sidebar-toggle-hide" type="button" class="inline-flex rounded-2xl border border-white/10 bg-white/5 p-2 text-slate-100 transition hover:bg-white/10">
                <i class="fas fa-toggle-off text-lg"></i>
            </button>

            <a href="{{ route('customer.home') }}" class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-3 py-2 transition hover:bg-white/10">
                <img class="h-10 w-10 rounded-xl object-cover" src="{{ asset('admin-assets/images/shopingo_logo-3.png') }}" alt="Logo">
                <span class="hidden text-sm font-semibold tracking-wide sm:inline">Shopingo Admin</span>
            </a>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <button id="menu-toggle" type="button" class="inline-flex rounded-2xl border border-white/10 bg-white/5 p-2 text-slate-100 transition hover:bg-white/10 md:hidden">
                <i class="fas fa-ellipsis-h text-lg"></i>
            </button>

            <div class="hidden items-center gap-2 md:flex">
                <div id="search-area" class="hidden items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-3 py-2">
                    <button id="search-area-hide" type="button" class="text-slate-300 transition hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                    <input id="search-input" type="text" class="w-0 bg-transparent text-sm text-white placeholder:text-slate-400 outline-none transition-all duration-300" placeholder="جستجو...">
                    <button type="button" class="text-slate-300 transition hover:text-white">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <button id="search-toggle" type="button" class="inline-flex rounded-2xl border border-white/10 bg-white/5 p-2 text-slate-100 transition hover:bg-white/10">
                    <i class="fas fa-search"></i>
                </button>

                <button id="full-screen" type="button" class="inline-flex rounded-2xl border border-white/10 bg-white/5 p-2 text-slate-100 transition hover:bg-white/10">
                    <i id="screen-compress" class="fas fa-compress hidden"></i>
                    <i id="screen-expand" class="fas fa-expand"></i>
                </button>
            </div>

            @php
                $unreadNotificationsCount = $notifications->whereNull('read_at')->count();
            @endphp

            <div class="relative">
                <button id="header-notification-toggle" type="button" class="relative inline-flex rounded-2xl border border-white/10 bg-white/5 p-2 text-slate-100 transition hover:bg-white/10">
                    <i class="far fa-bell text-lg"></i>
                    @if($unreadNotificationsCount !== 0)
                        <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">
                            {{ $unreadNotificationsCount }}
                        </span>
                    @endif
                </button>

                <section id="header-notification" class="header-notifictation absolute left-0 mt-3 hidden w-[22rem] overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl shadow-slate-950/10">
                    <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">
                        <span class="text-sm font-semibold text-slate-700">نوتیفیکیشن ها</span>
                        @if($unreadNotificationsCount !== 0)
                            <span class="rounded-full bg-rose-50 px-2 py-1 text-[11px] font-semibold text-rose-600">جدید</span>
                        @endif
                    </div>
                    <ul class="max-h-80 divide-y divide-slate-100 overflow-y-auto">
                        @foreach($notifications as $notification)
                            <li class="px-4 py-3 transition hover:bg-slate-50">
                                <div class="flex gap-3">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('admin-assets/images/avatar-3.jpg') }}" alt="avatar">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-slate-700">اعلان سیستم</p>
                                        <p class="mt-1 text-sm leading-6 text-slate-500">{{ $notification['data']['message'] }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <div class="relative">
                <button id="header-comment-toggle" type="button" class="relative inline-flex rounded-2xl border border-white/10 bg-white/5 p-2 text-slate-100 transition hover:bg-white/10">
                    <i class="far fa-comment-alt text-lg"></i>
                    @if($unSeenComment->count() !== 0)
                        <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">
                            {{ $unSeenComment->count() }}
                        </span>
                    @endif
                </button>

                <section id="header-comment" class="header-comment absolute left-0 mt-3 hidden w-[28rem] overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl shadow-slate-950/10">
                    <div class="border-b border-slate-100 px-4 py-4">
                        <div class="rounded-2xl bg-slate-50 px-3 py-2">
                            <input type="text" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400" placeholder="جستجو ...">
                        </div>
                    </div>
                    <div class="max-h-80 overflow-y-auto">
                        <ul class="divide-y divide-slate-100">
                            @foreach($unSeenComment as $Comment)
                                <li class="px-4 py-3 transition hover:bg-slate-50">
                                    <div class="flex gap-3">
                                        <img src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="avatar" class="h-10 w-10 rounded-full object-cover">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-start justify-between gap-3">
                                                <h5 class="text-sm font-semibold text-slate-700">{{ $Comment->author->fullName }}</h5>
                                                <span class="inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                                            </div>
                                            <p class="mt-1 text-sm leading-6 text-slate-500">{{ $Comment->body }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>

            <div class="relative">
                <button id="header-profile-toggle" type="button" class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-3 py-2 text-left transition hover:bg-white/10">
                    <img class="h-9 w-9 rounded-full object-cover ring-2 ring-white/20" src="{{ asset(auth()->user()->profile_photo_path ?? 'admin-assets/images/avatar-2.jpg') }}" alt="">
                    <span class="hidden max-w-40 truncate text-sm font-medium text-white sm:inline">
                        {{ auth()->user()->full_name ?? auth()->user()->email ?? auth()->user()->mobile ?? '-' }}
                    </span>
                    <i class="fas fa-angle-down text-slate-300"></i>
                </button>

                <section id="header-profile" class="header-profile absolute left-0 mt-3 hidden w-56 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl shadow-slate-950/10">
                    <div class="p-2">
                        <a href="{{ route('admin.setting.index') }}" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                            <i class="fas fa-cog w-5 text-slate-400"></i>
                            <span>تنظیمات</span>
                        </a>
                        <a href="{{ route('admin.user.admin-user.index') }}" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                            <i class="fas fa-user w-5 text-slate-400"></i>
                            <span>کاربر</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                            <i class="far fa-envelope w-5 text-slate-400"></i>
                            <span>پیام ها</span>
                        </a>
                        <button form="lock_form" class="flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                            <i class="fas fa-lock w-5 text-slate-400"></i>
                            <span>قفل صفحه</span>
                        </button>
                        <button form="logout_form" class="flex w-full items-center gap-3 rounded-2xl px-3 py-3 text-sm font-medium text-rose-600 transition hover:bg-rose-50">
                            <i class="fas fa-sign-out-alt w-5 text-rose-500"></i>
                            <span>خروج</span>
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </div>
</header>

<form class="hidden" action="{{ route('auth.customer.logout') }}" method="POST" id="logout_form">@csrf</form>
<form action="{{ route('lock-screen.lock') }}" method="POST" class="hidden" id="lock_form">@csrf</form>
