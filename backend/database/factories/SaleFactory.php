<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 100, 1000);
        return [
            'amount' => $amount,
            'sale_date' => $this->faker->dateTimeBetween(
                startDate: date('Y-01-01'),
                endDate: 'now'
            )->format('Y-m-d'),
        ];
    }
}
