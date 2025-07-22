<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
  public function run()
 {
    $this->call([
        LocationsSeeder::class,
        ArtistsSeeder::class,
        EventsSeeder::class,
        TicketTypesSeeder::class,
        DiscountsSeeder::class,
        TicketPackagesSeeder::class,
        PurchasesSeeder::class,
        TicketsSeeder::class,
    ]);
 }
}