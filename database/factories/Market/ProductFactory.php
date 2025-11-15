<?php

namespace Database\Factories\Market;

use App\Models\Market\Brand;
use App\Models\Market\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Market\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = Brand::pluck('id')->toArray();
        return [
            "name" => $this->faker->name(),
            "description" => $this->faker->text(),
            "slug" => $this->faker->slug(),
            "image" => $this->faker->imageUrl(),
            "weight" => $this->faker->numberBetween(1,10),
            "width" => $this->faker->numberBetween(1,10),
            "height" => $this->faker->numberBetween(1,10),
            "price" => $this->faker->numberBetween(100000,999999),
            "status" => $this->faker->numberBetween(0,1),
            "marketable" => $this->faker->numberBetween(0,1),
            "tags" => $this->faker->word(),
            "frozen_number" => $this->faker->numberBetween(0,1),
            "marketable_number" => $this->faker->numberBetween(1,50),
            "brand_id" => $this->faker->randomElement($brands),
            "product_categories" => $this->faker->randomElement(ProductCategory::pluck('id')->toArray()),
            "published_at" => $this->faker->date(),
        ];
    }
}
