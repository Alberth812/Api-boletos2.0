<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['scheduled', 'completed'];
        $cities = ['Ciudad de México', 'Monterrey', 'Guadalajara', 'Cancún', 'Puebla', 'Tijuana'];

        foreach (range(1, 30) as $index) {
            Event::create([
                'name' => fake()->sentence(3),
                'description' => fake()->paragraph(),
                'start_datetime' => now()->addDays(rand(1, 90))->setHour(rand(18, 22))->setMinute(0),
                'end_datetime' => now()->addDays(rand(1, 90))->addHours(3),
                'location_id' => rand(1, 10),
                'status' => fake()->randomElement($statuses),
                'venue_name' => fake()->company,
                'city' => fake()->randomElement($cities),
                'country' => 'México',
            ])->artists()->attach(
                fake()->randomElements(range(1, 30), rand(1, 3))
            );
        }
    }
}