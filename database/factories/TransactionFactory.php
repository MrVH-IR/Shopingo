<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'user_id' => User::factory(),
            'payment_status' => fake()->randomElement(['pending', 'success', 'failed']),
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer']),
        ];
    }
}
