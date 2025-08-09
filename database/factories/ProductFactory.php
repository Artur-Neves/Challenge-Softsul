<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
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
            'user_name'     => $this->faker->name(),
            'order_date'    => $this->faker->dateTimeBetween('-1 month', 'now'),
            'delivery_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status'        => $this->faker->randomElement(ProductStatus::values()),
        ];
    }
}
