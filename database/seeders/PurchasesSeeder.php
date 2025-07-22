<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchasesSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::inRandomOrder()->take(10)->get()->each(function ($user) {
            foreach (range(1, rand(1, 5)) as $i) {
                Purchase::create([
                    'user_id' => $user->id,
                    'total_amount' => fake()->randomFloat(2, 1000, 10000),
                    'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'oxxo']),
                    'payment_status' => fake()->randomElement(['completed', 'pending', 'refunded']),
                    'transaction_id' => 'TX-' . strtoupper(fake()->unique()->bothify('????-######')),
                ]);
            }
        });
    }
}