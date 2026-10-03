<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'year' => $this->faker->numberBetween(1900, (int) date('Y')),
            'model' => $this->faker->unique()->word(),
            'color' => $this->faker->numberBetween(0, 1)
                ? $this->faker->hexColor()
                : $this->faker->colorName()
        ];
    }
}
