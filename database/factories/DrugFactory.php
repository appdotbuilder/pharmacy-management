<?php

namespace Database\Factories;

use App\Models\Drug;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drug>
 */
class DrugFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Antibiotics', 'Pain Relief', 'Heart Medicine', 'Diabetes', 'Blood Pressure', 'Vitamins', 'Cold & Flu'];
        $units = ['tablets', 'capsules', 'bottles', 'boxes', 'pieces'];

        return [
            'name' => $this->faker->words(2, true) . ' ' . $this->faker->randomNumber(2) . 'mg',
            'generic_name' => $this->faker->words(2, true),
            'brand' => $this->faker->company(),
            'category' => $this->faker->randomElement($categories),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'stock_quantity' => $this->faker->numberBetween(0, 1000),
            'minimum_stock' => $this->faker->numberBetween(5, 50),
            'unit' => $this->faker->randomElement($units),
            'expiry_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'batch_number' => 'BATCH-' . $this->faker->randomNumber(6),
            'requires_prescription' => $this->faker->boolean(30),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the drug is low on stock.
     */
    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock_quantity' => random_int(0, 5),
            'minimum_stock' => 10,
        ]);
    }

    /**
     * Indicate that the drug is expired.
     */
    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'expiry_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }
}