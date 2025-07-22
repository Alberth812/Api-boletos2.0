<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    protected $model = Artist::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name . ' Band',
            'genre' => $this->faker->randomElement(['Rock', 'Pop', 'Electrónica', 'Reggaeton', 'Hip Hop']),
            'bio' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}