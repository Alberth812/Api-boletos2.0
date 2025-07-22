<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    public function run(): void
    {
        $codes = ['BOLETOS20', 'FANCLUB15', 'PRIMERA_COMPRA', 'EVENTO10', 'VERANO25', 'GRUPO30', 'ESTUDIANTE', 'FAMILIA'];

        foreach ($codes as $code) {
            Discount::create([
                'code' => $code,
                'description' => 'Descuento especial para usuarios registrados',
                'discount_type' => 'percentage',
                'percentage' => intval(str_replace(['%', 'BOLETOS', 'FANCLUB', 'VERANO', 'GRUPO'], '', $code)),
                'valid_from' => now(),
                'valid_to' => now()->addMonths(3),
                'max_uses' => 50,
                'used_count' => 0,
                'is_active' => true,
            ]);
        }
    }
}