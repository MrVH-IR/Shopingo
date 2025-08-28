<?php

namespace Database\Factories\Content;

use App\Models\Content\FAQ;
use Illuminate\Database\Eloquent\Factories\Factory;

class FAQFactory extends Factory
{

    protected $model = FAQ::class;
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(),
            'answer' => $this->faker->paragraph(),
            'slug' => $this->faker->slug(),
            'status' => $this->faker->numberBetween(0, 1),
            'tags' => implode(',', $this->faker->words(3)),
        ];
    }
}
