<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypesSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Event::all()->each(function ($event) {
            TicketType::factory(rand(2, 4))->create([
                'event_id' => $event->id
            ]);
        });
    }
}