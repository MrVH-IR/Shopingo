<aside id="sidebar" class="sidebar hidden lg:block" style="width: 250px">
    @php
        $marketGroups = [
            [
                'title' => 'ویترین',
                'icon' => 'fa-store',
                'items' => [
                    ['label' => 'دسته بندی', 'icon' => 'fa-th-large', 'route' => route('admin.market.category.index')],
                    ['label' => 'فرم کالا', 'icon' => 'fa-list-alt', 'route' => route('admin.market.property.index')],
                    ['label' => 'برند ها', 'icon' => 'fa-tags', 'route' => route('admin.market.brand.index')],
                    ['label' => 'کالا ها', 'icon' => 'fa-box', 'route' => route('admin.market.product.index')],
                    ['label' => 'انبار', 'icon' => 'fa-warehouse', 'route' => route('admin.market.store.index')],
                    ['label' => 'نظرات', 'icon' => 'fa-comments', 'route' => route('admin.market.comment.index')],
                ],
            ],
            [
                'title' => 'سفارشات',
                'icon' => 'fa-box',
                'items' => [
                    ['label' => 'جدید', 'icon' => 'fa-plus', 'route' => route('admin.market.order.newOrders')],
                    ['label' => 'در حال ارسال', 'icon' => 'fa-shipping-fast', 'route' => route('admin.market.order.sending')],
                    ['label' => 'پرداخت نشده', 'icon' => 'fa-exclamation-circle', 'route' => route('admin.market.order.unpaid')],
                    ['label' => 'باطل شده', 'icon' => 'fa-ban', 'route' => route('admin.market.order.canceled')],
                    ['label' => 'مرجوعی', 'icon' => 'fa-undo-alt', 'route' => route('admin.market.order.returned')],
                    ['label' => 'تمام سفارشات', 'icon' => 'fa-list', 'route' => route('admin.market.order.all')],
                ],
            ],
            [
                'title' => 'پرداخت ها',
                'icon' => 'fa-credit-card',
                'items' => [
                    ['label' => 'تمام پرداخت ها', 'icon' => 'fa-receipt', 'route' => route('admin.market.payment.index')],
                    ['label' => 'پرداخت های آنلاین', 'icon' => 'fa-globe', 'route' => route('admin.market.payment.online')],
                    ['label' => 'پرداخت های آفلاین', 'icon' => 'fa-money-bill', 'route' => route('admin.market.payment.offline')],
                    ['label' => 'پرداخت در محل', 'icon' => 'fa-map-marker-alt', 'route' => route('admin.market.payment.cash')],
                ],
            ],
                [
                    'title' => 'تخفیف ها',
                    'icon' => 'fa-tags',
                    'items' => [
                        ['label' => 'کوپن تخفیف', 'icon' => 'fa-ticket-alt', 'route' => route('admin.market.discount.copan')],
                        ['label' => 'تخفیف عمومی', 'icon' => 'fa-percent', 'route' => route('admin.market.discount.commonDiscount')],
                        ['label' => 'فروش شگفت انگیز', 'icon' => 'fa-bolt', 'route' => route('admin.market.discount.amazingSale')],
                    ],
                ],
                [
                    'title' => 'ارسال',
                    'icon' => 'fa-truck-fast',
                    'items' => [
                        ['label' => 'روش های ارسال', 'icon' => 'fa-truck-fast', 'route' => route('admin.market.delivery.index')],
                    ],
                ],
            ];

        $openGroups = [
            'admin.market.category.',
            'admin.market.property.',
            'admin.market.brand.',
            'admin.market.product.',
            'admin.market.store.',
            'admin.market.comment.',
            'admin.market.order.',
            'admin.market.payment.',
            'admin.market.discount.',
        ];
        $currentRoute = request()->route()?->getName();
        $activeGroup = collect($openGroups)->first(fn ($prefix) => str_starts_with((string) $currentRoute, $prefix));
    @endphp

    <section class="sidebar-container bg-slate-950 text-slate-100 mt-6">
        <section class="sidebar-wrapper">
            <div class="px-3 pb-3">
                <a href="{{ route('customer.home') }}" target="_blank" class="mb-3 flex items-center gap-3 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm font-semibold text-emerald-200 transition hover:bg-emerald-400/15">
                    <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-400/15 text-emerald-300">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                    <span>فروشگاه</span>
                </a>

                <a href="{{ route('admin.home') }}" class="sidebar-link flex items-center rounded-2xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                    <i class="fas fa-home"></i>
                    <span>خانه</span>
                </a>
            </div>

            <section class="sidebar-part-title">بخش فروش</section>

            @foreach($marketGroups as $group)
                @php $isOpen = $activeGroup === 'admin.market.' || $activeGroup === 'admin.market' || false; @endphp
                @php
                    $groupPrefix = match ($group['title']) {
                        'ویترین' => 'admin.market.category.',
                        'سفارشات' => 'admin.market.order.',
                        'پرداخت ها' => 'admin.market.payment.',
                        'تخفیف ها' => 'admin.market.discount.',
                        default => '',
                    };
                    $groupActive = $currentRoute && str_starts_with($currentRoute, $groupPrefix);
                @endphp
                <section class="sidebar-group-link mx-3 rounded-3xl border border-white/10 bg-white/5 p-2 transition">
                    <button type="button" class="sidebar-dropdown-toggle flex w-full items-center rounded-2xl px-3 py-3 text-right transition hover:bg-white/5" data-sidebar-toggle>
                        <i class="fas {{ $group['icon'] }} icon w-8 text-cyan-300"></i>
                        <span class="flex-1 text-sm font-semibold text-slate-100">{{ $group['title'] }}</span>
                        <i class="angle fas {{ $groupActive ? 'fa-angle-down' : 'fa-angle-left' }} ml-auto text-slate-400 transition-transform"></i>
                    </button>

                    <section class="sidebar-dropdown mt-2 space-y-1 rounded-2xl bg-slate-900/80 p-2 {{ $groupActive ? '' : 'hidden' }}">
                        @foreach($group['items'] as $item)
                            <a href="{{ $item['route'] }}" class="flex items-center gap-3 rounded-2xl px-3 py-2.5 text-sm text-slate-300 transition hover:bg-white/10 hover:text-white">
                                <i class="fas {{ $item['icon'] }} w-8 text-slate-400"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </section>
                </section>
            @endforeach

            <section class="sidebar-part-title">بخش محتوی</section>
            <section class="mx-3 space-y-1 rounded-3xl border border-white/10 bg-white/5 p-2">
                <a href="{{ route('admin.content.category.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-folder-open"></i><span>دسته بندی</span></a>
                <a href="{{ route('admin.content.post.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-newspaper"></i><span>پست ها</span></a>
                <a href="{{ route('admin.content.comment.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-comment-dots"></i><span>نظرات</span></a>
                <a href="{{ route('admin.content.menu.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-bars"></i><span>منو</span></a>
                <a href="{{ route('admin.content.faq.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-circle-question"></i><span>سوالات متداول</span></a>
                <a href="{{ route('admin.content.page.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-file-lines"></i><span>پیج ساز</span></a>
                <a href="{{ route('admin.content.banner.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-image"></i><span>بنرها</span></a>
            </section>

            <section class="sidebar-part-title">بخش کاربران</section>
            <section class="mx-3 space-y-1 rounded-3xl border border-white/10 bg-white/5 p-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-user-shield"></i><span>کاربران ادمین</span></a>
                <a href="{{ route('admin.user.customer.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-user"></i><span>مشتریان</span></a>
                <a href="{{ route('admin.user.role.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-user-tag"></i><span>سطوح دسترسی</span></a>
            </section>

            <section class="sidebar-part-title">تیکت ها</section>
            <section class="mx-3 space-y-1 rounded-3xl border border-white/10 bg-white/5 p-2">
                <a href="{{ route('admin.ticket.category.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-tags"></i><span>دسته بندی تیکت ها</span></a>
                <a href="{{ route('admin.ticket.priority.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-signal"></i><span>اولویت تیکت ها</span></a>
                <a href="{{ route('admin.ticket.admin.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-user-shield"></i><span>ادمین تیکت ها</span></a>
                <a href="{{ route('admin.ticket.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-ticket"></i><span>همه ی تیکت ها</span></a>
                <a href="{{ route('admin.ticket.newtickets') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-envelope-open-text"></i><span>تیکت های جدید</span></a>
                <a href="{{ route('admin.ticket.opentickets') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-folder-open"></i><span>تیکت های باز</span></a>
                <a href="{{ route('admin.ticket.closetickets') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-folder-minus"></i><span>تیکت های بسته</span></a>
            </section>

            <section class="sidebar-part-title">اطلاع رسانی</section>
            <section class="mx-3 space-y-1 rounded-3xl border border-white/10 bg-white/5 p-2">
                <a href="{{ route('admin.email.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-envelope"></i><span>اعلامیه ایمیلی</span></a>
                <a href="{{ route('admin.sms.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-sms"></i><span>اعلامیه پیامک</span></a>
            </section>

            <section class="sidebar-part-title">تنظیمات</section>
            <section class="mx-3 mb-4 space-y-1 rounded-3xl border border-white/10 bg-white/5 p-2">
                <a href="{{ route('admin.setting.index') }}" class="sidebar-link flex items-center rounded-2xl px-3 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"><i class="fas fa-sliders-h"></i><span>تنظیمات سایت</span></a>
            </section>
        </section>
    </section>
</aside>
