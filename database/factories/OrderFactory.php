<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => mt_rand(1, 10),
            'order_number' => $this->faker->unique()->randomNumber(5),
            'total_price' => $this->faker->randomNumber(5),
            'status' => $this->faker->randomElement(['sedang diproses', 'selesai'])
        ];
    }
}
