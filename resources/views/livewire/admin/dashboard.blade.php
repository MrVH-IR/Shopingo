<div class="p-6 bg-white dark:bg-zinc-800 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">داشبورد مدیریت</h2>

    <!-- آمار کلی -->
    <div class="grid grid-cols-3 gap-6">
        <div class="bg-blue-500 text-white p-4 rounded-lg dark:bg-blue-600">
            <h3 class="text-lg font-semibold">تعداد محصولات</h3>
            <p class="text-3xl font-bold">{{ $totalProducts }}</p>
        </div>

        <div class="bg-green-500 text-white p-4 rounded-lg dark:bg-green-600">
            <h3 class="text-lg font-semibold">تعداد سفارشات</h3>
            <p class="text-3xl font-bold">{{ $totalOrders }}</p>
        </div>

        <div class="bg-yellow-500 text-white p-4 rounded-lg dark:bg-yellow-600">
            <h3 class="text-lg font-semibold">تعداد کاربران</h3>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>
    </div>

    <!-- تراکنش‌ها -->
    <div class="grid grid-cols-2 gap-6 mt-6">
        <div class="bg-green-500 text-white p-4 rounded-lg dark:bg-green-600">
            <h3 class="text-lg font-semibold">تراکنش‌های موفق</h3>
            <p class="text-3xl font-bold">{{ $successfulTransactions }}</p>
        </div>

        <div class="bg-red-500 text-white p-4 rounded-lg dark:bg-red-600">
            <h3 class="text-lg font-semibold">تراکنش‌های ناموفق</h3>
            <p class="text-3xl font-bold">{{ $failedTransactions }}</p>
        </div>
    </div>

    <!-- آخرین سفارشات -->
    <div class="mt-6">
        <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">آخرین سفارشات</h3>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-zinc-900 shadow-md rounded-lg">
                <thead class="bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white">
                    <tr>
                        <th class="border p-3 text-center">کد سفارش</th>
                        <th class="border p-3 text-center">مشتری</th>
                        <th class="border p-3 text-center">مبلغ</th>
                        <th class="border p-3 text-center">وضعیت</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 dark:divide-gray-600 bg-white dark:bg-zinc-800 text-gray-900 dark:text-gray-200">
                    @foreach ($latestOrders as $order)
                        <tr wire:key="order-{{ $order->id }}" class="hover:bg-gray-100 dark:hover:bg-zinc-700 transition">
                            <td class="border p-3 text-center whitespace-nowrap">{{ $order->id }}</td>
                            <td class="border p-3 text-center whitespace-nowrap">{{ $order->user->name ?? 'نامشخص' }}</td>
                            <td class="border p-3 text-center text-green-700 dark:text-green-400 font-bold whitespace-nowrap">
                                {{ number_format($order->total_price) }} تومان
                            </td>
                            <td class="border p-3 text-center whitespace-nowrap">{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
