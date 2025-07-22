<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Arena',
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => 'México',
            'capacity' => $this->faker->numberBetween(1000, 50000),
        ];
    }
}