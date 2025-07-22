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
                        <i class="fas fa-chart-bar icon"></i>
                        <span>ویترین</span>
                        <i class="fas fa-angle-left angle"></i>
                    </section>
                    <section class="sidebar-dropdown">
                        <a href="{{ route('admin.market.category.index') }}">دسته بندی</a>
                        <a href="{{ route('admin.market.property.index') }}">فرم کالا</a>
                        <a href="{{ route('admin.market.brand.index') }}">برند ها</a>
                        <a href="{{ route('admin.market.product.index') }}">کالا ها</a>
                        <a href="{{ route('admin.market.store.index') }}">انبار</a>
                        <a href="{{ route('admin.market.comment.index') }}">نظرات</a>
                    </section>
                </section>

                <section class="sidebar-group-link">
                    <section class="sidebar-dropdown-toggle">
                        <i class="fa fa-first-order"></i>
                        <span>سفارشات</span>
                        <i class="fas fa-angle-left angle"></i>
                    </section>
                    <section class="sidebar-dropdown">
                        <a href="{{ route('admin.market.order.newOrders') }}">جدید</a>
                        <a href="{{ route('admin.market.order.sending') }}">در حال ارسال</a>
                        <a href="{{ route('admin.market.order.unpaid') }}">پرداخت نشده</a>
                        <a href="{{ route('admin.market.order.canceled') }}">باطل شده</a>
                        <a href="{{ route('admin.market.order.returned') }}">مرجوعی</a>
                        <a href="{{ route('admin.market.order.all') }}">تمام سفارشات</a>
                    </section>
                </section>

                <section class="sidebar-group-link">
                    <section class="sidebar-dropdown-toggle">
                        <i class="fa fa-credit-card"></i>
                        <span>پرداخت ها</span>
                        <i class="fas fa-angle-left angle"></i>
                    </section>
                    <section class="sidebar-dropdown">
                        <a href="{{ route('admin.market.payment.index') }}">تمام پرداخت ها</a>
                        <a href="{{ route('admin.market.payment.index') }}">پرداخت های آنلاین</a>
                        <a href="{{ route('admin.market.payment.index') }}">پرداخت های آفلاین</a>
                        <a href="{{ route('admin.market.payment.index') }}">پرداخت در محل</a>
                    </section>
                </section>

                <section class="sidebar-group-link">
                    <section class="sidebar-dropdown-toggle">
                        <i class="fa fa-minus-square"></i>
                        <span>تخفیف ها</span>
                        <i class="fas fa-angle-left angle"></i>
                    </section>
                    <section class="sidebar-dropdown">
                        <a href="{{ route('admin.market.discount.copan') }}">کوپن تخفیف</a>
                        <a href="{{ route('admin.market.discount.commonDiscount') }}">تخفیف عمومی</a>
                        <a href="{{ route('admin.market.discount.amazingSale') }}">فروش شگفت انگیز</a>
                    </section>
                </section>

            <a href="{{ route('admin.market.delivery.index') }}" class="sidebar-link">
                <i class="fa fa-paper-plane"></i>
                <span>روش های ارسال</span>
            </a>

            <section class="sidebar-part-title">بخش محتوی</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fa fa-th"></i>
                    <span>دسته ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.content.category.index') }}">دسته بندی</a>
                    <a href="{{ route('admin.content.post.index') }}">پست ها</a>
                    <a>نظرات</a>
                    <a href="{{ route('admin.content.menu.index') }}">منو</a>
                    <a href="{{ route('admin.content.faq.index') }}">سوالات متداول</a>
                    <a href="{{ route('admin.content.page.index') }}">پیج ساز</a>
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
                    <a href="{{ route('admin.user.admin-user.index') }}">کاربران ادمین</a>
                    <a href="{{ route('admin.user.customer.index') }}">مشتریان</a>
                    <a href="{{ route('admin.user.role.index') }}">سطوح دسترسی</a>
                </section>
            </section>

            <section class="sidebar-part-title">تیکت ها</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fa fa-share"></i>
                    <span>تنظیمات تیکت</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="#">تیکت های جدید</a>
                    <a href="#">تیکت های باز</a>
                    <a href="#">تیکت های بسته</a>
                </section>
            </section>

            <section class="sidebar-part-title">اطلاع رسانی</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-reply icon"></i>
                    <span>اعلامیه</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="#">اعلامیه ایمیلی</a>
                    <a href="#">اعلامیه پیامک</a>
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
                    <a href="#">تنظیمات</a>
                </section>
            </section>

        </section>
    </section>
</aside>
