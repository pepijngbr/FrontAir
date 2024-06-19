<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Airport::factory()->count(20)->create();
        Airport::factory()->create([
            'name' => 'Eindhoven Airport',
            'city' => 'Eindhoven',
            'country' => 'The Netherlands',
            'iata' => 'EIN',
            'icao' => 'EHEH',
            'type' => 'medium_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Schiphol Airport',
            'city' => 'Amsterdam',
            'country' => 'The Netherlands',
            'iata' => 'AMS',
            'icao' => 'EHAM',
            'type' => 'large_airport'
        ]);
        Airport::factory()->create([
            'name' => 'The Hague Airport',
            'city' => 'Rotterdam',
            'country' => 'The Netherlands',
            'iata' => 'RTM',
            'icao' => 'EHRD',
            'type' => 'medium_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Airport Eelde',
            'city' => 'Groningen',
            'country' => 'The Netherlands',
            'iata' => 'GRQ',
            'icao' => 'EHGG',
            'type' => 'medium_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Aachen Airport',
            'city' => 'Maastricht',
            'country' => 'The Netherlands',
            'iata' => 'MST',
            'icao' => 'EHBK',
            'type' => 'medium_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Lelystad Airport',
            'city' => 'Lelystad',
            'country' => 'The Netherlands',
            'iata' => 'LEY',
            'icao' => 'EHLE',
            'type' => 'medium_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Los Angeles Int. Airport',
            'city' => 'Los Angeles',
            'country' => 'United States',
            'iata' => 'LAX',
            'icao' => 'KLAX',
            'type' => 'large_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Heathrow Airport',
            'city' => 'London',
            'country' => 'United Kingdom',
            'iata' => 'LHR',
            'icao' => 'EGLL',
            'type' => 'large_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Charles de Gaulle Airport',
            'city' => 'Paris',
            'country' => 'France',
            'iata' => 'CDG',
            'icao' => 'LFPG',
            'type' => 'large_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Beijing Int. Airport',
            'city' => 'Beijing',
            'country' => 'China',
            'iata' => 'PEK',
            'icao' => 'ZBAA',
            'type' => 'large_airport'
        ]);
    }
}
