<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistsSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['Rock', 'Pop', 'Electrónica', 'Reggaeton', 'Hip Hop', 'Indie', 'Metal', 'Salsa', 'Trap', 'Alternativo'];

        for ($i = 1; $i <= 30; $i++) {
            Artist::create([
                'name' => fake()->firstName . ' ' . fake()->lastName,
                'genre' => fake()->randomElement($genres),
                'bio' => fake()->paragraph(3),
                'image_url' => fake()->imageUrl(640, 480, 'people'),
            ]);
        }
    }
}