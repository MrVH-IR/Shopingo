@php
    $currentRoute = request()->route()?->getName();

    $marketGroups = [
        [
            'title' => 'ویترین',
            'icon' => 'fa-store',
            'active' => [
                'admin.market.category.*',
                'admin.market.property.*',
                'admin.market.brand.*',
                'admin.market.product.*',
                'admin.market.store.*',
                'admin.market.comment.*',
            ],
            'items' => [
                ['label' => 'دسته بندی', 'icon' => 'fa-table-cells-large', 'route' => route('admin.market.category.index'), 'active' => 'admin.market.category.*'],
                ['label' => 'فرم کالا', 'icon' => 'fa-list-check', 'route' => route('admin.market.property.index'), 'active' => 'admin.market.property.*'],
                ['label' => 'برند ها', 'icon' => 'fa-tags', 'route' => route('admin.market.brand.index'), 'active' => 'admin.market.brand.*'],
                ['label' => 'کالا ها', 'icon' => 'fa-box', 'route' => route('admin.market.product.index'), 'active' => 'admin.market.product.*'],
                ['label' => 'انبار', 'icon' => 'fa-warehouse', 'route' => route('admin.market.store.index'), 'active' => 'admin.market.store.*'],
                ['label' => 'نظرات', 'icon' => 'fa-comments', 'route' => route('admin.market.comment.index'), 'active' => 'admin.market.comment.*'],
            ],
        ],
        [
            'title' => 'سفارشات',
            'icon' => 'fa-bag-shopping',
            'active' => ['admin.market.order.*'],
            'items' => [
                ['label' => 'جدید', 'icon' => 'fa-plus', 'route' => route('admin.market.order.newOrders'), 'active' => 'admin.market.order.newOrders'],
                ['label' => 'در حال ارسال', 'icon' => 'fa-truck-fast', 'route' => route('admin.market.order.sending'), 'active' => 'admin.market.order.sending'],
                ['label' => 'پرداخت نشده', 'icon' => 'fa-circle-exclamation', 'route' => route('admin.market.order.unpaid'), 'active' => 'admin.market.order.unpaid'],
                ['label' => 'باطل شده', 'icon' => 'fa-ban', 'route' => route('admin.market.order.canceled'), 'active' => 'admin.market.order.canceled'],
                ['label' => 'مرجوعی', 'icon' => 'fa-rotate-left', 'route' => route('admin.market.order.returned'), 'active' => 'admin.market.order.returned'],
                ['label' => 'تمام سفارشات', 'icon' => 'fa-list', 'route' => route('admin.market.order.all'), 'active' => 'admin.market.order.all'],
            ],
        ],
        [
            'title' => 'پرداخت ها',
            'icon' => 'fa-credit-card',
            'active' => ['admin.market.payment.*'],
            'items' => [
                ['label' => 'تمام پرداخت ها', 'icon' => 'fa-receipt', 'route' => route('admin.market.payment.index'), 'active' => 'admin.market.payment.index'],
                ['label' => 'پرداخت های آنلاین', 'icon' => 'fa-globe', 'route' => route('admin.market.payment.online'), 'active' => 'admin.market.payment.online'],
                ['label' => 'پرداخت های آفلاین', 'icon' => 'fa-money-bill', 'route' => route('admin.market.payment.offline'), 'active' => 'admin.market.payment.offline'],
                ['label' => 'پرداخت در محل', 'icon' => 'fa-location-dot', 'route' => route('admin.market.payment.cash'), 'active' => 'admin.market.payment.cash'],
            ],
        ],
        [
            'title' => 'تخفیف ها',
            'icon' => 'fa-tags',
            'active' => ['admin.market.discount.*'],
            'items' => [
                ['label' => 'کوپن تخفیف', 'icon' => 'fa-ticket', 'route' => route('admin.market.discount.copan'), 'active' => 'admin.market.discount.copan'],
                ['label' => 'تخفیف عمومی', 'icon' => 'fa-percent', 'route' => route('admin.market.discount.commonDiscount'), 'active' => 'admin.market.discount.commonDiscount'],
                ['label' => 'فروش شگفت انگیز', 'icon' => 'fa-bolt', 'route' => route('admin.market.discount.amazingSale'), 'active' => 'admin.market.discount.amazingSale'],
            ],
        ],
        [
            'title' => 'ارسال',
            'icon' => 'fa-truck-fast',
            'active' => ['admin.market.delivery.*'],
            'items' => [
                ['label' => 'روش های ارسال', 'icon' => 'fa-truck-fast', 'route' => route('admin.market.delivery.index'), 'active' => 'admin.market.delivery.*'],
            ],
        ],
    ];

    $simpleSections = [
        [
            'title' => 'محتوا',
            'icon' => 'fa-layer-group',
            'items' => [
                ['label' => 'دسته بندی', 'icon' => 'fa-folder-open', 'route' => route('admin.content.category.index'), 'active' => 'admin.content.category.*'],
                ['label' => 'پست ها', 'icon' => 'fa-newspaper', 'route' => route('admin.content.post.index'), 'active' => 'admin.content.post.*'],
                ['label' => 'نظرات', 'icon' => 'fa-comment-dots', 'route' => route('admin.content.comment.index'), 'active' => 'admin.content.comment.*'],
                ['label' => 'منو', 'icon' => 'fa-bars', 'route' => route('admin.content.menu.index'), 'active' => 'admin.content.menu.*'],
                ['label' => 'سوالات متداول', 'icon' => 'fa-circle-question', 'route' => route('admin.content.faq.index'), 'active' => 'admin.content.faq.*'],
                ['label' => 'پیج ساز', 'icon' => 'fa-file-lines', 'route' => route('admin.content.page.index'), 'active' => 'admin.content.page.*'],
                ['label' => 'بنرها', 'icon' => 'fa-image', 'route' => route('admin.content.banner.index'), 'active' => 'admin.content.banner.*'],
            ],
        ],
        [
            'title' => 'کاربران',
            'icon' => 'fa-users',
            'items' => [
                ['label' => 'کاربران ادمین', 'icon' => 'fa-user-shield', 'route' => route('admin.user.admin-user.index'), 'active' => 'admin.user.admin-user.*'],
                ['label' => 'مشتریان', 'icon' => 'fa-user', 'route' => route('admin.user.customer.index'), 'active' => 'admin.user.customer.*'],
                ['label' => 'سطوح دسترسی', 'icon' => 'fa-user-tag', 'route' => route('admin.user.role.index'), 'active' => 'admin.user.role.*'],
            ],
        ],
        [
            'title' => 'تیکت ها',
            'icon' => 'fa-ticket',
            'items' => [
                ['label' => 'دسته بندی تیکت ها', 'icon' => 'fa-tags', 'route' => route('admin.ticket.category.index'), 'active' => 'admin.ticket.category.*'],
                ['label' => 'اولویت تیکت ها', 'icon' => 'fa-signal', 'route' => route('admin.ticket.priority.index'), 'active' => 'admin.ticket.priority.*'],
                ['label' => 'ادمین تیکت ها', 'icon' => 'fa-user-shield', 'route' => route('admin.ticket.admin.index'), 'active' => 'admin.ticket.admin.*'],
                ['label' => 'همه ی تیکت ها', 'icon' => 'fa-ticket', 'route' => route('admin.ticket.index'), 'active' => ['admin.ticket.index', 'admin.ticket.show']],
                ['label' => 'تیکت های جدید', 'icon' => 'fa-envelope-open-text', 'route' => route('admin.ticket.newtickets'), 'active' => 'admin.ticket.newtickets'],
                ['label' => 'تیکت های باز', 'icon' => 'fa-folder-open', 'route' => route('admin.ticket.opentickets'), 'active' => 'admin.ticket.opentickets'],
                ['label' => 'تیکت های بسته', 'icon' => 'fa-folder-minus', 'route' => route('admin.ticket.closetickets'), 'active' => 'admin.ticket.closetickets'],
            ],
        ],
        [
            'title' => 'اطلاع رسانی',
            'icon' => 'fa-bullhorn',
            'items' => [
                ['label' => 'اعلامیه ایمیلی', 'icon' => 'fa-envelope', 'route' => route('admin.email.index'), 'active' => 'admin.email.*'],
                ['label' => 'اعلامیه پیامک', 'icon' => 'fa-mobile-screen-button', 'route' => route('admin.sms.index'), 'active' => 'admin.sms.*'],
            ],
        ],
        [
            'title' => 'تنظیمات',
            'icon' => 'fa-sliders',
            'items' => [
                ['label' => 'تنظیمات سایت', 'icon' => 'fa-sliders', 'route' => route('admin.setting.index'), 'active' => 'admin.setting.*'],
            ],
        ],
    ];

    $matches = static function ($patterns) {
        foreach ((array) $patterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return true;
            }
        }
        return false;
    };

    $isHome = $currentRoute === 'admin.home';
@endphp

<aside
    id="sidebar"
    class="print:hidden fixed right-0 top-20 bottom-0 z-50 flex w-[280px] shrink-0 -translate-x-full flex-col border-l border-white/10 bg-slate-950 text-slate-100 shadow-2xl shadow-slate-950/30 transition-transform duration-300 lg:sticky lg:top-20 lg:z-30 lg:h-[calc(100vh-5rem)] lg:translate-x-0 lg:shadow-none"
    x-show="!sidebarCollapsed || sidebarOpen"
    x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
>
    <div class="border-b border-white/10 bg-gradient-to-b from-slate-900 to-slate-950 px-4 pb-4 pt-4">
        <div class="mb-4 flex items-center gap-3">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                <img src="{{ asset('admin-assets/images/shopingo_logo-3.png') }}" alt="Shopingo" class="h-full w-full object-cover">
            </div>
            <div class="min-w-0">
                <p class="truncate text-sm font-bold text-white">Shopingo Admin</p>
                <p class="mt-1 text-xs text-slate-400">مدیریت فروشگاه</p>
            </div>
            <button type="button" class="mr-auto inline-flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white lg:hidden" x-on:click="sidebarOpen = false" aria-label="بستن منو">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <a href="{{ route('admin.home') }}" class="group flex items-center justify-center gap-2 rounded-2xl border px-3 py-2.5 text-xs font-semibold transition {{ $isHome ? 'border-cyan-400/30 bg-cyan-400/15 text-cyan-200' : 'border-white/10 bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white' }}">
                <i class="fa-solid fa-house text-[11px] {{ $isHome ? 'text-cyan-300' : 'text-slate-400 group-hover:text-white' }}"></i>
                <span>خانه</span>
            </a>
            <a href="{{ route('customer.home') }}" target="_blank" class="group flex items-center justify-center gap-2 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-3 py-2.5 text-xs font-semibold text-emerald-200 transition hover:bg-emerald-400/15">
                <i class="fa-solid fa-store text-[11px] text-emerald-300"></i>
                <span>فروشگاه</span>
            </a>
        </div>
    </div>

    <nav class="min-h-0 flex-1 overflow-y-auto px-3 py-4 [scrollbar-width:thin] [scrollbar-color:rgb(71_85_105)_transparent]">
        <div class="mb-5">
            <div class="mb-2 flex items-center gap-2 px-2 text-[11px] font-bold tracking-wide text-slate-500">
                <span class="h-px flex-1 bg-white/5"></span>
                <span>بخش فروش</span>
                <i class="fa-solid fa-store text-[10px] text-slate-600"></i>
            </div>

            <div class="space-y-2">
                @foreach($marketGroups as $group)
                    @php $groupActive = $matches($group['active']); @endphp
                    <div x-data="{ open: {{ $groupActive ? 'true' : 'false' }} }" class="overflow-hidden rounded-2xl border {{ $groupActive ? 'border-cyan-400/20 bg-white/[0.055]' : 'border-white/5 bg-white/[0.025]' }} transition hover:border-white/10">
                        <button type="button" x-on:click="open = !open" class="flex w-full items-center gap-3 px-3 py-3 text-right transition hover:bg-white/5">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl {{ $groupActive ? 'bg-cyan-400/10 text-cyan-300' : 'bg-white/5 text-slate-400' }}">
                                <i class="fa-solid {{ $group['icon'] }} text-sm"></i>
                            </span>
                            <span class="flex-1 text-xs font-bold {{ $groupActive ? 'text-white' : 'text-slate-300' }}">{{ $group['title'] }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 transition-transform duration-200" x-bind:class="open ? 'rotate-180 text-cyan-300' : ''"></i>
                        </button>

                        <div x-show="open" x-transition.origin.top.duration.200ms>
                            <div class="space-y-1 border-t border-white/5 px-2 pb-2 pt-2">
                                @foreach($group['items'] as $item)
                                    @php $itemActive = $matches($item['active']); @endphp
                                    <a href="{{ $item['route'] }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium transition {{ $itemActive ? 'bg-cyan-400 text-slate-950 shadow-lg shadow-cyan-950/20' : 'text-slate-400 hover:bg-white/10 hover:text-white' }}" @if($itemActive) aria-current="page" @endif>
                                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg {{ $itemActive ? 'bg-black/10 text-slate-900' : 'bg-white/5 text-slate-500 group-hover:text-slate-200' }}">
                                            <i class="fa-solid {{ $item['icon'] }} text-[11px]"></i>
                                        </span>
                                        <span class="truncate">{{ $item['label'] }}</span>
                                        @if($itemActive)
                                            <i class="fa-solid fa-angle-left mr-auto text-[10px]"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @foreach($simpleSections as $section)
            @php
                $sectionActive = collect($section['items'])->contains(fn ($item) => $matches($item['active']));
            @endphp
            <div class="mb-5 last:mb-0">
                <div class="mb-2 flex items-center gap-2 px-2 text-[11px] font-bold tracking-wide text-slate-500">
                    <span class="h-px flex-1 bg-white/5"></span>
                    <span>{{ $section['title'] }}</span>
                    <i class="fa-solid {{ $section['icon'] }} text-[10px] text-slate-600"></i>
                </div>

                <div class="space-y-1 rounded-2xl border border-white/5 bg-white/[0.025] p-2 {{ $sectionActive ? 'border-white/10' : '' }}">
                    @foreach($section['items'] as $item)
                        @php $itemActive = $matches($item['active']); @endphp
                        <a href="{{ $item['route'] }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-medium transition {{ $itemActive ? 'bg-cyan-400 text-slate-950 shadow-lg shadow-cyan-950/20' : 'text-slate-400 hover:bg-white/10 hover:text-white' }}" @if($itemActive) aria-current="page" @endif>
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl {{ $itemActive ? 'bg-black/10 text-slate-900' : 'bg-white/5 text-slate-500 group-hover:text-slate-200' }}">
                                <i class="fa-solid {{ $item['icon'] }} text-[11px]"></i>
                            </span>
                            <span class="truncate">{{ $item['label'] }}</span>
                            @if($itemActive)
                                <i class="fa-solid fa-angle-left mr-auto text-[10px]"></i>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <div class="border-t border-white/10 bg-slate-950 px-3 py-3">
        <div class="flex items-center gap-3 rounded-2xl border border-white/5 bg-white/[0.035] px-3 py-3">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-cyan-400/10 text-cyan-300">
                <i class="fa-solid fa-shield-halved text-sm"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-xs font-semibold text-slate-200">پنل مدیریت</p>
                <p class="mt-1 text-[10px] text-slate-500">Shopingo Admin Panel</p>
            </div>
            <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-lg shadow-emerald-500/40"></span>
        </div>
    </div>
</aside>

<div
    class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"
    x-show="sidebarOpen"
    x-transition.opacity.duration.200ms
    x-on:click="sidebarOpen = false"
></div>
