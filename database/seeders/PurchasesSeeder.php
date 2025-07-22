<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Database\Seeder;

Class PurchasesSeeder extends Seeder{
  public function run(): void
  {
     \App\Models\User::inRandomOrder()->take(10)->get()->each(function ($user) {
            $purchases = Purchase::factory(rand(1, 3))->create([
                'user_id' => $user->id
            ]);
        });         
  }

}
