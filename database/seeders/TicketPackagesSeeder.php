<?php

namespace Database\Seeders;

use App\Models\TicketPackage;
use Illuminate\Database\Seeder;

class TicketPackagesSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Event::inRandomOrder()->take(30)->get()->each(function ($event) {
            TicketPackage::create([
                'name' => fake()->word() . ' Experience',
                'description' => fake()->sentence(6),
                'price' => fake()->numberBetween(2000, 8000),
                'event_id' => $event->id,
                'max_tickets' => fake()->numberBetween(2, 6),
                'is_active' => true,
            ]);
        });
    }
}