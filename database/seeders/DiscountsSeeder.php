<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    public function run(): void
    {
        Discount::factory(8)->create();
    }
}