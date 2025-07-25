<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

            <a href="{{ route('admin.home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <section class="sidebar-part-title">بخش فروش</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-store icon"></i>
                    <span>ویترین</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.category.index') }}"><i class="fas fa-th-large"></i> دسته بندی</a>
                    <a href="{{ route('admin.market.property.index') }}"><i class="fas fa-list-alt"></i> فرم کالا</a>
                    <a href="{{ route('admin.market.brand.index') }}"><i class="fas fa-tags"></i> برند ها</a>
                    <a href="{{ route('admin.market.product.index') }}"><i class="fas fa-box"></i> کالا ها</a>
                    <a href="{{ route('admin.market.store.index') }}"><i class="fas fa-warehouse"></i> انبار</a>
                    <a href="{{ route('admin.market.comment.index') }}"><i class="fas fa-comments"></i> نظرات</a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-box icon"></i>
                    <span>سفارشات</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.order.newOrders') }}"><i class="fas fa-plus"></i> جدید</a>
                    <a href="{{ route('admin.market.order.sending') }}"><i class="fas fa-shipping-fast"></i> در حال ارسال</a>
                    <a href="{{ route('admin.market.order.unpaid') }}"><i class="fas fa-exclamation-circle"></i> پرداخت نشده</a>
                    <a href="{{ route('admin.market.order.canceled') }}"><i class="fas fa-ban"></i> باطل شده</a>
                    <a href="{{ route('admin.market.order.returned') }}"><i class="fas fa-undo-alt"></i> مرجوعی</a>
                    <a href="{{ route('admin.market.order.all') }}"><i class="fas fa-list"></i> تمام سفارشات</a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-credit-card icon"></i>
                    <span>پرداخت ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.payment.index') }}"><i class="fas fa-receipt"></i> تمام پرداخت ها</a>
                    <a href="{{ route('admin.market.payment.index') }}"><i class="fas fa-globe"></i> پرداخت های آنلاین</a>
                    <a href="{{ route('admin.market.payment.index') }}"><i class="fas fa-money-bill"></i> پرداخت های آفلاین</a>
                    <a href="{{ route('admin.market.payment.index') }}"><i class="fas fa-map-marker-alt"></i> پرداخت در محل</a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-tags icon"></i>
                    <span>تخفیف ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.discount.copan') }}"><i class="fas fa-ticket-alt"></i> کوپن تخفیف</a>
                    <a href="{{ route('admin.market.discount.commonDiscount') }}"><i class="fas fa-percent"></i> تخفیف عمومی</a>
                    <a href="{{ route('admin.market.discount.amazingSale') }}"><i class="fas fa-bolt"></i> فروش شگفت انگیز</a>
                </section>
            </section>

            <a href="{{ route('admin.market.delivery.index') }}" class="sidebar-link">
                <i class="fas fa-shipping-fast"></i>
                <span>روش های ارسال</span>
            </a>

            <section class="sidebar-part-title">بخش محتوی</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-th-large icon"></i>
                    <span>دسته ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.content.category.index') }}"><i class="fas fa-folder-open"></i> دسته بندی</a>
                    <a href="{{ route('admin.content.post.index') }}"><i class="fas fa-newspaper"></i> پست ها</a>
                    <a><i class="fas fa-comment-dots"></i> نظرات</a>
                    <a href="{{ route('admin.content.menu.index') }}"><i class="fas fa-bars"></i> منو</a>
                    <a href="{{ route('admin.content.faq.index') }}"><i class="fas fa-question-circle"></i> سوالات متداول</a>
                    <a href="{{ route('admin.content.page.index') }}"><i class="fas fa-pager"></i> پیج ساز</a>
                </section>
            </section>

            <section class="sidebar-part-title">بخش کاربران</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-users icon"></i>
                    <span>کاربران</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.user.admin-user.index') }}"><i class="fas fa-user-shield"></i> کاربران ادمین</a>
                    <a href="{{ route('admin.user.customer.index') }}"><i class="fas fa-user"></i> مشتریان</a>
                    <a href="{{ route('admin.user.role.index') }}"><i class="fas fa-user-tag"></i> سطوح دسترسی</a>
                </section>
            </section>

            <section class="sidebar-part-title">تیکت ها</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-ticket-alt icon"></i>
                    <span>تنظیمات تیکت</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.ticket.newtickets') }}"><i class="fas fa-envelope-open-text"></i> تیکت های جدید</a>
                    <a href="{{ route('admin.ticket.opentickets') }}"><i class="fas fa-folder-open"></i> تیکت های باز</a>
                    <a href="{{ route('admin.ticket.closetickets') }}"><i class="fas fa-folder-minus"></i> تیکت های بسته</a>
                </section>
            </section>

            <section class="sidebar-part-title">اطلاع رسانی</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-bullhorn icon"></i>
                    <span>اعلامیه</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.email.index') }}"><i class="fas fa-envelope"></i> اعلامیه ایمیلی</a>
                    <a href="{{ route('admin.sms.index') }}"><i class="fas fa-sms"></i> اعلامیه پیامک</a>
                </section>
            </section>

            <section class="sidebar-part-title">تنظیمات</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-cogs icon"></i>
                    <span>تنظیمات سایت</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.setting.index') }}"><i class="fas fa-sliders-h"></i> تنظیمات</a>
                </section>
            </section>

        </section>
    </section>
</aside>
