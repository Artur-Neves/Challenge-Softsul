<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
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
            'customer_name'     => $this->faker->name(),
            'order_date'    => $this->faker->dateTimeBetween('-1 month', 'now'),
            'delivery_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status'        => $this->faker->randomElement(OrderStatus::values()),
        ];
    }
}
