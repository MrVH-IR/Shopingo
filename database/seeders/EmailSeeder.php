<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10 ; $i++) {
            DB::table("public_mail")->insert([
                "subject" => "این یک ایمیل تست است",
                "body" => "متن پیام این ایمیل برای تست است",
                "status" => 1,
                "published_at" => now()
            ]);
        }
    }
}
