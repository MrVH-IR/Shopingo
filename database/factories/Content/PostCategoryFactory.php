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
        $timestamp = time();

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'image' => [
                'indexArray' => [
                    'large' => "images/post-category/2025/08/21/{$timestamp}/{$timestamp}_large.jpg",
                    'medium' => "images/post-category/2025/08/21/{$timestamp}/{$timestamp}_medium.jpg",
                    'small' => "images/post-category/2025/08/21/{$timestamp}/{$timestamp}_small.jpg",
                ],
                'directory' => "images/post-category/2025/08/21/{$timestamp}",
                'currentImage' => 'large',
            ],
            'status' => (int) $this->faker->boolean(),
            'tags' => implode(',', $this->faker->words(3)),
        ];
    }
}
