<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Airline::factory()->create([
            'name' => 'Ryanair',
            'iata' => 'FR',
            'icao' => 'RYR',
            'callsign' => 'Ryanair',
            'country' => 'Ireland',
            'operating_since' => 1984
        ]);
        Airline::factory()->create([
            'name' => 'Wizz Air',
            'iata' => 'W6',
            'icao' => 'WZZ',
            'callsign' => 'Wizz Air',
            'country' => 'Hungary',
            'operating_since' => 2003
        ]);
        Airline::factory()->create([
            'name' => 'EasyJet',
            'iata' => 'U2',
            'icao' => 'EZY',
            'callsign' => 'Easy',
            'country' => 'United Kingdom',
            'operating_since' => 1995
        ]);
        Airline::factory()->create([
            'name' => 'Lufthansa',
            'iata' => 'LH',
            'icao' => 'DLH',
            'callsign' => 'Lufthansa',
            'country' => 'Germany',
            'operating_since' => 1955
        ]);
        Airline::factory()->create([
            'name' => 'British Airways',
            'iata' => 'BA',
            'icao' => 'BAW',
            'callsign' => 'Speedbird',
            'country' => 'United Kingdom',
            'operating_since' => 1974
        ]);
        Airline::factory()->create([
            'name' => 'KLM',
            'iata' => 'KL',
            'icao' => 'KLM',
            'callsign' => 'KLM',
            'country' => 'Netherlands',
            'operating_since' => 1919
        ]);
        Airline::factory()->create([
            'name' => 'Emirates',
            'iata' => 'EK',
            'icao' => 'UAE',
            'callsign' => 'Emirates',
            'country' => 'United Arab Emirates',
            'operating_since' => 1985
        ]);
        Airline::factory()->create([
            'name' => 'TUI',
            'iata' => 'TUI',
            'icao' => 'TUI',
            'callsign' => 'TUI',
            'country' => 'United Kingdom',
            'operating_since' => 2003
        ]);
        Airline::factory()->create([
            'name' => 'Transavia',
            'iata' => 'HV',
            'icao' => 'TRA',
            'callsign' => 'Transavia',
            'country' => 'Netherlands',
            'operating_since' => 1965
        ]);
        Airline::factory()->create([
            'name' => 'Martinair',
            'iata' => 'MP',
            'icao' => 'MPH',
            'callsign' => 'Martinair',
            'country' => 'Netherlands',
            'operating_since' => 1958
        ]);
    }
}
