<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Content\FAQ;
use App\Models\Content\Page;
use App\Models\Content\Post;
use App\Models\Notify\Email;
use App\Models\Content\Comment;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\RoleSeeder;
use App\Models\Content\PostCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory(10)->create();
       PostCategory::factory()->count(1)->state(['status' => 0])->create();
       Post::factory()->count(10)->state(['status' => 0])->create();
       FAQ::factory(10)->count(10)->state(['status' => 0])->create();
       Page::factory()->count(10)->state(['status' => 0])->create();
       Comment::factory()->count(10)->forPost()->create();
       Email::factory()->count(10)->create(); // You Can Activate This Instead Of Seeder
        $this->call([
            SMSSeeder::class,
            EmailSeeder::class,
            UserSeeder::class, // Password is shopingo
            TicketCategorySeeder::class,
            TicketPrioritySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
        ]);
    }
}
