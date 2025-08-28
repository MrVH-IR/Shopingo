<?php

namespace Database\Factories\Content;

use App\Models\Content\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    protected $model = Page::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'slug' => $this->faker->slug(),
            'status' => $this->faker->numberBetween(0, 1),
            'tags' => implode(',' , $this->faker->words(3)),
        ];
    }
}
