<?php

namespace Database\Factories;

use App\Models\TicketType;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketTypeFactory extends Factory
{
    protected $model = TicketType::class;

    public function definition(): array
    {
        $isVip = $this->faker->boolean(30); // 30% probabilidad de ser VIP

        return [
            'event_id' => Event::factory(),
            'name' => $isVip ? 'VIP' : $this->faker->randomElement(['General', 'Preferente', 'Palco']),
            'price' => $isVip ? $this->faker->numberBetween(1000, 5000) : $this->faker->numberBetween(200, 999),
            'section' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'VIP']),
            'is_vip' => $isVip,
            'is_seat' => true,
            'seat_number' => null,
            'door_number' => $this->faker->numberBetween(1, 4),
            'capacity' => $cap = $this->faker->numberBetween(50, 1000),
            'available_tickets' => $cap,
        ];
    }
}