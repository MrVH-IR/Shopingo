<?php

namespace Database\Seeders;

use App\Models\Ticket\TicketPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = ["فوری" , "مهم" , "متوسط" , "کم اهمیت"];

        foreach($array as $value){
            TicketPriority::create([
               "name" => $value,
               "status" => 1
            ]);
        }
    }
}
