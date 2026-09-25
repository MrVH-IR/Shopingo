<?php

namespace Database\Seeders;

use App\Models\Market\CashPayment;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Payment;
use App\Models\User;
use App\Models\Content\FAQ;
use App\Models\Content\Page;
use App\Models\Content\Post;
use App\Models\Market\Brand;
use App\Models\Notify\Email;
use App\Models\Market\Product;
use App\Models\Content\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\AppData\CitySeeder;
use Database\Seeders\AppData\ProvinceSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use App\Models\Content\PostCategory;
use App\Models\Market\ProductCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::factory(10)->create();
//        PostCategory::factory()->count(1)->state(['status' => 0])->create();
//        Post::factory()->count(10)->state(['status' => 0])->create();
//        FAQ::factory(10)->count(10)->state(['status' => 0])->create();
//        Page::factory()->count(10)->state(['status' => 0])->create();
////        Brand::factory()->count(10)->create(); // Results in Error Bc of Image
//        ProductCategory::factory()->count(10)->create();
////        Product::factory()->count(10)->create(); // Results in Error Bc of Image
//        Comment::factory()->count(10)->forProduct()->create();
//        Comment::factory()->count(10)->forPost()->create();
//        Email::factory()->count(10)->create(); // You Can Activate This Instead Of Seeder
//        Payment::factory()->forOnlinePayments()->count(10)->create();
//        Payment::factory()->forOfflinePayments()->count(10)->create();
//        Payment::factory()->forCashPayments()->count(10)->create();
        $this->call([
//            SMSSeeder::class,
//            EmailSeeder::class,
//            UserSeeder::class, // Password is shopingo
//            TicketCategorySeeder::class,
//            TicketPrioritySeeder::class,
//            RoleSeeder::class,
//            DeliverySeeder::class,
//            ProvinceSeeder::class,
//            CitySeeder::class,
//            ProductCategorySeeder::class,
        ]);
    }
}
