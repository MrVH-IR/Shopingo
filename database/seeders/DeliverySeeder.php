<?php

namespace Database\Seeders;

use App\Models\Market\Delivery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliveries = [
            ['name' => 'پست پیشتاز' , "amount" => '600000' , 'delivery_time' => '2' , 'delivery_time_unit' => 'روز'],
            ['name' => 'اسنپ' , 'amount' => '2500000' , 'delivery_time' => '4' , 'delivery_time_unit' => 'ساعت'],
            ['name' => 'پیک موتوری' , 'amount' => '200000' , 'delivery_time' => '5' , 'delivery_time_unit' => 'ساعت']
        ];

        foreach ($deliveries as $delivery) {
            Delivery::create($delivery);
        }
    }
}
