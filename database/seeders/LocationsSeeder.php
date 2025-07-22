<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Arena CDMX', 'address' => 'Av. de los Insurgentes Sur 4617', 'city' => 'Ciudad de México', 'country' => 'México', 'capacity' => 20000],
            ['name' => 'Palacio de los Deportes', 'address' => 'Ciudad de la Juventud, Iztacalco', 'city' => 'Ciudad de México', 'country' => 'México', 'capacity' => 22000],
            ['name' => 'Auditorio Nacional', 'address' => 'Paseo de la Reforma 50', 'city' => 'Ciudad de México', 'country' => 'México', 'capacity' => 10000],
            ['name' => 'Estadio Azteca', 'address' => 'Calzada de Tlalpan 3465', 'city' => 'Ciudad de México', 'country' => 'México', 'capacity' => 87000],
            ['name' => 'Teatro Metropólitan', 'address' => 'Donceles 66', 'city' => 'Ciudad de México', 'country' => 'México', 'capacity' => 4000],
            ['name' => 'Arena Monterrey', 'address' => 'Blvd. Morelos 2000', 'city' => 'Monterrey', 'country' => 'México', 'capacity' => 17000],
            ['name' => 'Auditorio Benito Juárez', 'address' => 'Avenida Tecnológico 1000', 'city' => 'Guadalajara', 'country' => 'México', 'capacity' => 10000],
            ['name' => 'Complejo Cultural Bicentenario', 'address' => 'Boulevard del Maestro', 'city' => 'Chihuahua', 'country' => 'México', 'capacity' => 8000],
            ['name' => 'Polifórum Benito Juárez', 'address' => 'Avenida Niños Héroes', 'city' => 'Cancún', 'country' => 'México', 'capacity' => 12000],
            ['name' => 'Foro Sol', 'address' => 'Circuito Interior Pista Olímpica', 'city' => 'Ciudad de México', 'country' => 'México', 'capacity' => 70000],
        ];

        foreach ($locations as $loc) {
            Location::create($loc);
        }
    }
}