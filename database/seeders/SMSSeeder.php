<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('public_sms')->insert([
                "title" => "فروش ویژه",
                "body" => "این یک فروش ویژه است، لطفا این فرصت را از دست ندهید",
                "status" => "1",
                "published_at" => now(),
            ]);
        }
    }
}
