<?php

namespace Database\Factories\Content;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Content\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'summary' => $this->faker->paragraph(),
            'body' => $this->faker->paragraph(),
            'image' => 'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 10000),
            'status' => (int) $this->faker->boolean(),
            'tags' => implode(',', $this->faker->words(3)),
            'published_at' => $this->faker->date(),
            'author_id' => User::factory(),
            'category_id' => $this->faker->numberBetween(92,96),
        ];
    }
}
