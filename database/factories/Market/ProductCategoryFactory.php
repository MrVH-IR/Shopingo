<?php

namespace Database\Factories\Market;

use App\Models\Market\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Market\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductCategory::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "description" => $this->faker->sentence(),
            "slug"        => $this->faker->slug,
            "image"       => $this->faker->imageUrl(),
            "status"      => $this->faker->randomElement([1 , 0]),
            "show_in_menu" => $this->faker->randomElement([1, 0]),
            "tags"        => $this->faker->randomElement(["american" , "iranian" , "product"]),
            "parent_id" => null,
        ];
    }
}
