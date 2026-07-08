<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                <i class="fa-solid fa-wallet text-emerald-600"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold">
                    روش پرداخت
                </h2>
                <p class="text-sm text-gray-500">
                    یکی از روش‌های پرداخت زیر را انتخاب کنید.
                </p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex gap-3 mb-6">
            <i class="fa-solid fa-shield-heart text-amber-500 mt-1"></i>
            <p class="text-sm text-amber-700 leading-7">
                برای امنیت بیشتر، پرداخت اینترنتی پیشنهاد می‌شود.
            </p>
        </div>

        <div class="space-y-4">
            <!-- Online -->
            <input hidden type="radio" id="online" name="payment_type">
            <label
                for="online"
                class="payment-card flex items-center justify-between rounded-2xl border border-gray-200 p-5 cursor-pointer hover:border-blue-500 hover:shadow-lg transition">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-credit-card text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">
                            پرداخت آنلاین
                        </h3>
                        <p class="text-gray-500 text-sm">
                            پرداخت امن از طریق زرین پال
                        </p>
                    </div>
                </div>
                <i class="fa-regular fa-circle-check text-2xl text-gray-300"></i>
            </label>

            <!-- Wallet -->
            <input hidden type="radio" id="wallet" name="payment_type">
            <label
                for="wallet"
                class="payment-card flex items-center justify-between rounded-2xl border border-gray-200 p-5 cursor-pointer hover:border-green-500 hover:shadow-lg transition">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">
                        <i class="fa-solid fa-wallet text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">
                            کیف پول
                        </h3>
                        <p class="text-gray-500 text-sm">
                            پرداخت از موجودی کیف پول
                        </p>
                    </div>
                </div>
                <i class="fa-regular fa-circle-check text-2xl text-gray-300"></i>
            </label>

            <!-- COD -->
            <input hidden type="radio" id="cod" name="payment_type">
            <label
                for="cod"
                class="payment-card flex items-center justify-between rounded-2xl border border-gray-200 p-5 cursor-pointer hover:border-orange-500 hover:shadow-lg transition">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">
                        <i class="fa-solid fa-truck text-orange-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">
                            پرداخت در محل
                        </h3>
                        <p class="text-gray-500 text-sm">
                            پرداخت هنگام تحویل سفارش
                        </p>
                    </div>
                </div>
                <i class="fa-regular fa-circle-check text-2xl text-gray-300"></i>
            </label>
        </div>
    </div>
</div>
