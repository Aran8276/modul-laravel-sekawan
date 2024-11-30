<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use App\Models\Rak;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    protected static ?string $password;

    public function run(): void
    {

        // Penerbit::factory()->count(5)->create();
        // Penulis::factory()->count(5)->create();
        // Kategori::factory()->count(5)->create();
        // Rak::factory()->count(5)->create();

        Buku::factory()->count(50)->create();

        User::factory(25)->create();

        User::factory()->create([
            'user_id' => "admin",
            'user_nama' => "admin",
            'user_alamat' => "alamat admin",
            'user_username' => "admin",
            'user_email' => "admin@aran8276.site",
            'password' => static::$password ??= Hash::make('admin'),
            'user_notelp' => "0",
            'level' => "admin",
        ]);
    }
}
