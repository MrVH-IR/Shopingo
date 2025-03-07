<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Transaction;

class Dashboard extends Component
{
    // public function render()
    // {
    //     return view('livewire.admin.dashboard', [
    //         'totalProducts' => Product::count(),
    //         'totalOrders' => Order::count(),
    //         'totalUsers' => User::count(),
    //         'latestOrders' => Order::latest()->take(5)->get(),
    //         'bestSellingProducts' => Product::withCount('orderItems')
    //             ->orderByDesc('order_items_count')
    //             ->take(5)
    //             ->get(),
    //         'successfulTransactions' => Transaction::where('payment_status', 'success')->count(),
    //         'failedTransactions' => Transaction::where('payment_status', 'failed')->count(),
    //     ])->with('layout', 'layouts.admin');
    // }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
            'latestOrders' => Order::latest()->take(5)->get(),
            'bestSellingProducts' => Product::withCount('orderItems')
                ->orderByDesc('order_items_count')
                ->take(5)
                ->get(),
            'successfulTransactions' => Transaction::where('payment_status', 'success')->count(),
            'failedTransactions' => Transaction::where('payment_status', 'failed')->count(),
            'categories' => \App\Models\Category::all(), // ارسال دسته‌بندی‌ها
        ])->with('layout', 'layouts.admin');
    }
}
