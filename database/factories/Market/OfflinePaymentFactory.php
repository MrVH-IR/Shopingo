<?php

namespace Database\Factories\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Market\OfflinePayment>
 */
class OfflinePaymentFactory extends Factory
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
            "transaction_id" => $this->faker->uuid(),
            "paid_date" => $this->faker->date(),
            "status" => $this->faker->randomElement([1 , 0])
        ];
    }
}
