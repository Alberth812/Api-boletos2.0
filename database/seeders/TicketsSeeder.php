<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Purchase::all()->each(function ($purchase) {
            $count = rand(1, 4);

            for ($i = 0; $i < $count; $i++) {
                $ticketType = \App\Models\TicketType::inRandomOrder()->first();

                Ticket::create([
                    'ticket_type_id' => $ticketType->id,
                    'user_id' => $purchase->user_id,
                    'purchase_id' => $purchase->id,
                    'seat_number' => 'F' . rand(1, 20) . '-A' . rand(1, 50),
                    'qr_code' => strtoupper(fake()->unique()->sha1),
                    'is_used' => fake()->boolean(20),
                    'is_cancelled' => fake()->boolean(5),
                    'issued_at' => now()->subDays(rand(0, 7)),
                ]);
            }
        });
    }
}