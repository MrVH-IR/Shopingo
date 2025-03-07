<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Category::factory(5)->create()->each(function ($category) {
            Product::factory(10)->create(['category_id' => $category->id]);
        });

        Order::factory(10)->create()->each(function ($order) {
            OrderItem::factory(3)->create(['order_id' => $order->id]);
            Transaction::factory()->create(['order_id' => $order->id, 'user_id' => $order->user_id]);
        });
    }
}
