<?php

namespace Database\Factories\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Market\OnlinePayment>
 */
class OnlinePaymentFactory extends Factory
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
            "gateway" => $this->faker->randomElement(["Melli", "Mellat" , "Saderat" , "ZarrinPal"]),
            "transaction_id" => $this->faker->uuid(),
            "bank_first_response" => $this->faker->text(),
            "bank_second_response" => $this->faker->text(),
            "status" => $this->faker->randomElement([1 , 0])
        ];
    }
}
