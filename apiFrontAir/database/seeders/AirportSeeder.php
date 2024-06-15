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
            'name' => 'Amsterdam Airport Schiphol',
            'city' => 'Amsterdam',
            'country' => 'The Netherlands',
            'iata' => 'AMS',
            'icao' => 'EHAM',
            'type' => 'large_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Klein Brögel Airport',
            'city' => 'Peer',
            'country' => 'Belgium',
            'iata' => 'EBBL',
            'icao' => 'EBBL',
            'type' => 'small_airport'
        ]);
        Airport::factory()->create([
            'name' => 'Rotterdam The Hague Airport',
            'city' => 'Rotterdam',
            'country' => 'The Netherlands',
            'iata' => 'RTM',
            'icao' => 'EHRD',
            'type' => 'medium_airport'
        ]);

        Airport::factory()->create([
            'name' => 'Groningen Airport Eelde',
            'city' => 'Groningen',
            'country' => 'The Netherlands',
            'iata' => 'GRQ',
            'icao' => 'EHGG',
            'type' => 'medium_airport'
        ]);

        Airport::factory()->create([
            'name' => 'Maastricht Aachen Airport',
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
            'name' => 'Los Angeles International Airport',
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
            'name' => 'Dubai International Airport',
            'city' => 'Dubai',
            'country' => 'United Arab Emirates',
            'iata' => 'DXB',
            'icao' => 'OMDB',
            'type' => 'large_airport'
        ]);

        Airport::factory()->create([
            'name' => 'Beijing Capital International Airport',
            'city' => 'Beijing',
            'country' => 'China',
            'iata' => 'PEK',
            'icao' => 'ZBAA',
            'type' => 'large_airport'
        ]);

        Airport::factory()->create([
            'name' => 'Sydney Kingsford Smith Airport',
            'city' => 'Sydney',
            'country' => 'Australia',
            'iata' => 'SYD',
            'icao' => 'YSSY',
            'type' => 'large_airport'
        ]);
    }
}
