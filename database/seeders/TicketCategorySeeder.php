<?php

namespace Database\Seeders;

use App\Models\Ticket\TicketCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = ["فروش" , "مشکلات" , "باگ" , "مشکل در خرید" , "بازگشت پول"];

        foreach ($array as $value) {
            TicketCategory::create([
                "name" => $value,
                "status" => 1,
            ]);
        }
    }
}
