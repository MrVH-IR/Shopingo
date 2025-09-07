<?php

namespace Database\Factories\Notify;

use App\Models\Notify\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{

    protected $model = Email::class;
    public function definition(): array
    {
        return [
            "subject" => $this->faker->word(),
            "body" => $this->faker->text(),
            "status" => $this->faker->randomElement([0,1]),
            "published_at" => $this->faker->date(),
        ];
    }
}
