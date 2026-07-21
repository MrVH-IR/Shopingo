<?php

namespace App\Http\Services\Admin;

use App\Models\Market\Order;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AdminDashboardService
{
    public function stats(): array
    {
        return Cache::remember('admin.dashboard.stats', now()->addMinutes(10), function () {
            $now = now();
            $startOfToday = $now->copy()->startOfDay();
            $startOfYesterday = $now->copy()->subDay()->startOfDay();
            $endOfYesterday = $now->copy()->subDay()->endOfDay();
            $startOfTwoDaysAgo = $now->copy()->subDays(2)->startOfDay();

            $activeUsersCount = User::query()->whereNull('deleted_at')->count();
            $activeUsersYesterday = User::query()
                ->where('created_at', '<=', $endOfYesterday)
                ->where(function ($query) use ($endOfYesterday) {
                    $query->whereNull('deleted_at')
                        ->orWhere('deleted_at', '>', $endOfYesterday);
                })
                ->count();

            $newOrdersCount = Order::query()->where('order_status', 0)->count();
            $newOrdersYesterday = Order::query()
                ->where('order_status', 0)
                ->whereBetween('created_at', [$startOfTwoDaysAgo, $endOfYesterday])
                ->count();

            $netProfit = Order::query()
                ->where('payment_status', 1)
                ->sum('order_final_amount');
            $netProfitYesterday = Order::query()
                ->where('payment_status', 1)
                ->whereBetween('created_at', [$startOfYesterday, $endOfYesterday])
                ->sum('order_final_amount');

            $todaySales = Order::query()
                ->where('payment_status', 1)
                ->whereBetween('created_at', [$startOfToday, $now])
                ->sum('order_final_amount');
            $yesterdaySales = Order::query()
                ->where('payment_status', 1)
                ->whereBetween('created_at', [$startOfYesterday, $endOfYesterday])
                ->sum('order_final_amount');

            return [
                [
                    'title' => 'سود خالص',
                    'value' => number_format($netProfit) . ' تومان',
                    'delta' => $this->formatDelta($netProfit - $netProfitYesterday) . ' نسبت به دیروز',
                    'delta_value' => $netProfit - $netProfitYesterday,
                    'icon' => 'fas fa-chart-line',
                    'accent' => 'from-amber-500 to-orange-500',
                    'bg' => 'bg-amber-50',
                    'text' => 'text-amber-700',
                ],
                [
                    'title' => 'فروش امروز',
                    'value' => number_format($todaySales) . ' تومان',
                    'delta' => $this->formatDelta($todaySales - $yesterdaySales) . ' نسبت به دیروز',
                    'delta_value' => $todaySales - $yesterdaySales,
                    'icon' => 'fas fa-bag-shopping',
                    'accent' => 'from-emerald-500 to-teal-500',
                    'bg' => 'bg-emerald-50',
                    'text' => 'text-emerald-700',
                ],
                [
                    'title' => 'سفارش های جدید',
                    'value' => number_format($newOrdersCount),
                    'delta' => $this->formatDelta($newOrdersCount - $newOrdersYesterday),
                    'delta_value' => $newOrdersCount - $newOrdersYesterday,
                    'icon' => 'fas fa-truck-fast',
                    'accent' => 'from-sky-500 to-cyan-500',
                    'bg' => 'bg-sky-50',
                    'text' => 'text-sky-700',
                ],
                [
                    'title' => 'کاربران فعال',
                    'value' => number_format($activeUsersCount),
                    'delta' => $this->formatDelta($activeUsersCount - $activeUsersYesterday),
                    'delta_value' => $activeUsersCount - $activeUsersYesterday,
                    'icon' => 'fas fa-users',
                    'accent' => 'from-fuchsia-500 to-pink-500',
                    'bg' => 'bg-fuchsia-50',
                    'text' => 'text-fuchsia-700',
                ],
            ];
        });
    }

    private function formatDelta(int $delta): string
    {
        if ($delta === 0) {
            return '0';
        }

        return ($delta > 0 ? '+' : '') . number_format($delta);
    }
}
