<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypesSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Event::all()->each(function ($event) {
            $types = ['General', 'Preferente', 'VIP', 'Palco', 'Backstage'];

            foreach (range(1, rand(2, 3)) as $i) {
                $isVip = fake()->boolean(30);

                TicketType::create([
                    'event_id' => $event->id,
                    'name' => $isVip ? 'VIP' : fake()->randomElement(['General', 'Preferente']),
                    'price' => $isVip ? fake()->numberBetween(1500, 5000) : fake()->numberBetween(500, 1499),
                    'section' => fake()->randomElement(['A', 'B', 'C', 'D', 'VIP']),
                    'is_vip' => $isVip,
                    'is_seat' => true,
                    'seat_number' => null,
                    'door_number' => fake()->numberBetween(1, 4),
                    'capacity' => $cap = fake()->numberBetween(50, 1000),
                    'available_tickets' => $cap,
                ]);
            }
        });
    }
}