<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AirlineSeeder::class,
            AirportSeeder::class,
            FlightSeeder::class,
            TicketSeeder::class,
            DepartureGateSeeder::class,
            BaggageSeeder::class,
        ]);
    }
}
