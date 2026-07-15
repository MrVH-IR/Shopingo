<aside id="sidebar" class="w-full md:w-1/4">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-3 mb-3">
        <nav class="flex flex-col gap-1">
            <a href="{{ route('customer.profile.orders') }}"
               class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                      {{ request()->routeIs('customer.profile.orders')
                          ? 'bg-orange-50 text-orange-600 font-semibold'
                          : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                <span class="flex items-center justify-center w-9 h-9 rounded-lg
                             {{ request()->routeIs('customer.profile.orders')
                                 ? 'bg-orange-100 text-orange-600'
                                 : 'bg-gray-100 text-gray-500 group-hover:bg-orange-100 group-hover:text-orange-600' }}
                             transition-colors duration-200">
                    <i class="fa-solid fa-box"></i>
                </span>
                <span>سفارش‌های من</span>
            </a>
            <a href="{{ route('customer.profile.my-addresses') }}"
               class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                      {{ request()->routeIs('customer.profile.my-addresses')
                          ? 'bg-orange-50 text-orange-600 font-semibold'
                          : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                <span class="flex items-center justify-center w-9 h-9 rounded-lg
                             {{ request()->routeIs('customer.profile.my-addresses')
                                 ? 'bg-orange-100 text-orange-600'
                                 : 'bg-gray-100 text-gray-500 group-hover:bg-orange-100 group-hover:text-orange-600' }}
                             transition-colors duration-200">
                    <i class="fa-solid fa-location-dot"></i>
                </span>
                <span>آدرس‌های من</span>
            </a>
            <a href="{{ route('customer.profile.my-favorites') }}"
               class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                      {{ request()->routeIs('customer.profile.my-favorites')
                          ? 'bg-orange-50 text-orange-600 font-semibold'
                          : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                <span class="flex items-center justify-center w-9 h-9 rounded-lg
                             {{ request()->routeIs('customer.profile.my-favorites')
                                 ? 'bg-orange-100 text-orange-600'
                                 : 'bg-gray-100 text-gray-500 group-hover:bg-orange-100 group-hover:text-orange-600' }}
                             transition-colors duration-200">
                    <i class="fa-solid fa-heart"></i>
                </span>
                <span>لیست علاقه‌مندی</span>
            </a>
            <a href="{{ route('customer.profile.my-tickets') }}"
               class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                      {{ request()->routeIs('customer.profile.my-favorites')
                          ? 'bg-orange-50 text-orange-600 font-semibold'
                          : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                <span class="flex items-center justify-center w-9 h-9 rounded-lg
                             {{ request()->routeIs('customer.profile.my-favorites')
                                 ? 'bg-orange-100 text-orange-600'
                                 : 'bg-gray-100 text-gray-500 group-hover:bg-orange-100 group-hover:text-orange-600' }}
                             transition-colors duration-200">
                    <i class="fa-solid fa-heart"></i>
                </span>
                <span>مدیریت تیکت ها</span>
            </a>
            <a href=""
               class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                      {{ request()->routeIs('customer.profile.my-profile')
                          ? 'bg-orange-50 text-orange-600 font-semibold'
                          : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                <span class="flex items-center justify-center w-9 h-9 rounded-lg
                             {{ request()->routeIs('customer.profile.my-profile')
                                 ? 'bg-orange-100 text-orange-600'
                                 : 'bg-gray-100 text-gray-500 group-hover:bg-orange-100 group-hover:text-orange-600' }}
                             transition-colors duration-200">
                    <i class="fa-solid fa-user-pen"></i>
                </span>
                <span>ویرایش حساب</span>
            </a>
            <hr class="my-2 border-gray-100">
            <button form="logout-form"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl w-full text-right
                           text-red-500 hover:bg-red-50 transition-all duration-200">
                <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-red-50
                             group-hover:bg-red-100 transition-colors duration-200">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </span>
                <span>خروج از حساب کاربری</span>
            </button>
        </nav>
    </div>
</aside>
