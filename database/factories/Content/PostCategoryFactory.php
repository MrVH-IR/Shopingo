<?php

namespace Database\Factories\Content;

use App\Models\Content\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PostCategory::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'image' => 'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 10000),
            'status' => (int) $this->faker->boolean(),
            'tags' => implode(',', $this->faker->words(3)),
        ];
    }
}
