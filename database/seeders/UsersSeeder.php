<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create([
            'password' => bcrypt('4545') // Todos con la misma contraseña
        ]);
    }
}