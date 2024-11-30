<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use App\Models\Rak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buku_id' => fake()->unique()->numerify(),
            'buku_penulis_id' => Penulis::factory(),
            'buku_kategori_id' => Kategori::factory(),
            'buku_penerbit_id' => Penerbit::factory(),
            'buku_rak_id' => Rak::factory(),

            'buku_judul' => fake()->name(),
            'buku_isbn' => fake()->unique()->numerify(),
            'buku_thnterbit' => fake()->year(),
        ];
    }
}
