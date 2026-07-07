<section class="flex-1 hidden md:block">
    <div class="relative">
        <i
            class="fas fa-search absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 mt-2">
        </i>
        <input
            id="search"
            type="text"
            autocomplete="off"
            placeholder="جستجوی کالا، برند، دسته بندی ..."
            class="w-full h-11 rounded-2xl bg-gray-100 border border-transparent
                           focus:border-blue-500
                           focus:ring-4
                           focus:ring-blue-100
                           pr-14 pl-5
                           transition mr-3 mt-3">
        @include('customer.layouts.header.search-dropdown')
    </div>
</section>
