<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        Event::factory(15)
            ->hasAttached(\App\Models\Artist::factory()->count(2)) // 2 artistas por evento
            ->create();
    }
}