<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'start_datetime' => now()->addDays(rand(1, 60)),
            'end_datetime' => now()->addDays(rand(1, 60))->addHours(3),
            'location_id' => Location::factory(),
            'status' => $this->faker->randomElement(['scheduled', 'completed']),
            'venue_name' => $this->faker->company,
            'city' => $this->faker->city,
            'country' => 'México',
        ];
    }
}