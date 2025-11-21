<?php

namespace Database\Factories\Market;

use App\Models\Market\CashPayment;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Market\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "amount" => $this->faker->randomFloat(2, 10, 100000),
            "user_id" => User::factory()->create()->id,
            "status" => $this->faker->randomElement([1 , 0]),
            "type" => null
        ];
    }

    public function forOnlinePayments()
    {
        return $this->state([
            "type" => 0
        ])->for(OnlinePayment::factory(), 'paymentable');
    }

    public function forOfflinePayments()
    {
        return $this->state([
            "type" => 1
        ])->for(OfflinePayment::factory(), 'paymentable');
    }

    public function forCashPayments()
    {
        return $this->state([
            "type" => 2
        ])->for(CashPayment::factory(), 'paymentable');
    }
}
