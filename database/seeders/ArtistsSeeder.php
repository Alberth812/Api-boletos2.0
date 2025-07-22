<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistsSeeder extends Seeder
{
    public function run(): void
    {
        Artist::factory(20)->create();
    }
}