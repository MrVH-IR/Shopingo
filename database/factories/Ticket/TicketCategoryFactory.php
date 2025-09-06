<?php

namespace Database\Factories\Ticket;

use App\Models\Ticket\TicketCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket\TicketCategory>
 */
class TicketCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TicketCategory::class;
    public function definition(): array
    {
        return [
            //
        ];
    }
}
