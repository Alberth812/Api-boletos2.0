<?php

namespace Database\Factories;

use App\Models\TicketPackage;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketPackageFactory extends Factory
{
    protected $model = TicketPackage::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Experience',
            'description' => $this->faker->sentence(6),
            'price' => $this->faker->randomFloat(2, 1000, 10000),
            'event_id' => Event::factory(), // Relaciona con un evento existente o crea uno nuevo
            'max_tickets' => $this->faker->numberBetween(2, 6),
            'is_active' => $this->faker->boolean(90), // 90% activos
        ];
    }
}