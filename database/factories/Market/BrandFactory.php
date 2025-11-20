<?php

namespace Database\Factories\Market;

use App\Models\Market\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Market\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            "persian_name"  => $this->faker->name,
            "original_name" => $this->faker->name,
            "slug"          => $this->faker->slug,
            "image"         => $this->faker->imageUrl(),
            "status"        => $this->faker->randomElement([0, 1]),
            "tags"          => $this->faker->randomElement(["brand" , "american" , "iranian"])
        ];
    }
}
