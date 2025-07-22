<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first() ?? User::factory(),
            'total_amount' => $this->faker->randomFloat(2, 500, 10000),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'oxxo', 'spei']),
            'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed', 'refunded']),
            'transaction_id' => 'TX-' . strtoupper($this->faker->unique()->bothify('????-######')),
        ];
    }
}