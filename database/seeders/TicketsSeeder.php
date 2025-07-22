<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Purchase::all()->each(function ($purchase) {
            // Asigna entre 1 y 4 boletos por compra
            Ticket::factory(rand(1, 4))->create([
                'purchase_id' => $purchase->id,
                'user_id' => $purchase->user_id,
                'ticket_type_id' => \App\Models\TicketType::inRandomOrder()->first()->id
            ]);
        });
    }
}