<?php

namespace Database\Seeders;

use App\Models\TicketPackage;
use Illuminate\Database\Seeder;

class TicketPackagesSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Event::all()->each(function ($event) {
            TicketPackage::factory(rand(1, 2))->create([
                'event_id' => $event->id
            ]);
        });
    }
}