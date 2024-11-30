<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penulis>
 */
class PenulisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'penulis_id' => fake()->unique()->numerify(),
            'penulis_nama' => fake()->name(),
            'penulis_tmptlahir' => fake()->word(),
            'penulis_tgllahir'  => fake()->date(),
        ];
    }
}
