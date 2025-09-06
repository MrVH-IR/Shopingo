<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "email" => "admin@shopingo.com",
            "mobile" => "0912000000",
            "national_code" => "0023222222",
            "first_name" => "Shopingo",
            "last_name" => "Admin",
            "slug" => "admin-shopingo",
            "profile_photo_path" => null,
            "email_verified_at" => null,
            "password" => Hash::make("shopingo"),
            "activation" => 0,
            "activation_date" => null,
            "user_type" => 1,
            "status" => 0,
        ]);
    }
}
