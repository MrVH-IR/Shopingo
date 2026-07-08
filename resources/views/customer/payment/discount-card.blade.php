<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b bg-gradient-to-r from-blue-50 to-white">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center">
                <i class="fa-solid fa-ticket text-white"></i>
            </div>
            <div>
                <h2 class="font-bold text-xl text-gray-800">
                    کد تخفیف
                </h2>
                <p class="text-gray-500 text-sm">
                    اگر کد تخفیف دارید، اینجا وارد کنید.
                </p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4 flex gap-3 items-start mb-6">
            <i class="fa-solid fa-circle-info text-blue-600 mt-1"></i>
            <p class="text-blue-700 text-sm leading-7">
                پس از اعمال موفق کد تخفیف، مبلغ سفارش به صورت خودکار بروزرسانی خواهد شد.
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-3">
            <form class="d-none" action="{{ route('customer.sales-process.coupon-discount') }}" method="POST" id="coupon_form">@csrf</form>
            <input
                name="coupon"
                form="coupon_form"
                type="text"
                class="flex-1 rounded-xl border border-gray-200 px-5 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition"
                placeholder="مثلاً SUMMER1405">
            <button
                type="submit"
                class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 transition text-white font-bold"
                form="coupon_form">
                اعمال کد
            </button>
        </div>
    </div>
    @error('coupon')
    <div class="alert alert-danger ml-5 mr-5">
        <div>{{ $message }}</div>
    </div>
    @enderror
</div>
