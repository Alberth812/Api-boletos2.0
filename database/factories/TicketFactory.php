<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'ticket_type_id' => TicketType::factory(),
            'user_id' => User::factory(),
            'purchase_id' => Purchase::factory(),
            'seat_number' => 'F' . rand(1, 20) . '-A' . rand(1, 50),
            'qr_code' => strtoupper($this->faker->unique()->sha1),
            'is_used' => $this->faker->boolean(20),
            'is_cancelled' => $this->faker->boolean(5),
            'issued_at' => now()->subDays(rand(0, 7)),
        ];
    }
}