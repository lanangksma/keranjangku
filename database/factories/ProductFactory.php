<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        return [
            'category_id' => mt_rand(1, 10),
            'name' => $this->faker->word(),
            'price' => $this->faker->randomNumber(5),
            'stock' => $this->faker->randomNumber(2),
            'description' => $this->faker->paragraph(mt_rand(4, 10)),
            'image' => $this->faker->imageUrl(),
            'slug' => $this->faker->slug()
        ];
    }
}
