<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rak>
 */
class RakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rak_id' => fake()->unique()->numerify(),
            'rak_nama' => fake()->name(),
            'rak_lokasi' => fake()->bothify("?-#"),
            'rak_kapasitas' => fake()->numberBetween(10, 50),
        ];
    }
}
