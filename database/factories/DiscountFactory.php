<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    protected $model = Discount::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['percentage', 'fixed']);
        $validFrom = now()->addDays(-1);
        $validTo = now()->addMonths(2);

        return [
            'code' => strtoupper($this->faker->unique()->lexify('???????')),
            'description' => $this->faker->sentence,
            'discount_type' => $type,
            'amount' => $type === 'fixed' ? $this->faker->randomElement([50, 100, 200, 500]) : null,
            'percentage' => $type === 'percentage' ? $this->faker->numberBetween(5, 50) : null,
            'valid_from' => $validFrom,
            'valid_to' => $validTo,
            'max_uses' => $this->faker->numberBetween(1, 100),
            'used_count' => 0,
            'is_active' => true,
        ];
    }
}