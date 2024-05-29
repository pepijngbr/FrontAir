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
        // Airline::factory()->count(10)->create();
        Airline::factory()->create([
            'name' => 'Ryanair',
            'iata_code' => 'FR',
            'icao_code' => 'RYR',
            'callsign' => 'Ryanair',
            'country' => 'Ireland',
            'operating_since' => 1984
        ]);
        Airline::factory()->create([
            'name' => 'Wizz Air',
            'iata_code' => 'W6',
            'icao_code' => 'WZZ',
            'callsign' => 'Wizz Air',
            'country' => 'Hungary',
            'operating_since' => 2003
        ]);
        Airline::factory()->create([
            'name' => 'EasyJet',
            'iata_code' => 'U2',
            'icao_code' => 'EZY',
            'callsign' => 'Easy',
            'country' => 'United Kingdom',
            'operating_since' => 1995
        ]);
        Airline::factory()->create([
            'name' => 'Lufthansa',
            'iata_code' => 'LH',
            'icao_code' => 'DLH',
            'callsign' => 'Lufthansa',
            'country' => 'Germany',
            'operating_since' => 1955
        ]);
        Airline::factory()->create([
            'name' => 'British Airways',
            'iata_code' => 'BA',
            'icao_code' => 'BAW',
            'callsign' => 'Speedbird',
            'country' => 'United Kingdom',
            'operating_since' => 1974
        ]);
        // Airline::factory()->create([
        //     'name' => 'Air France',
        //     'iata_code' => 'AF',
        //     'icao_code' => 'AFR',
        //     'callsign' => 'Airfrans',
        //     'country' => 'France',
        //     'operating_since' => 1933
        // ]);
        Airline::factory()->create([
            'name' => 'KLM',
            'iata_code' => 'KL',
            'icao_code' => 'KLM',
            'callsign' => 'KLM',
            'country' => 'Netherlands',
            'operating_since' => 1919
        ]);
        // Airline::factory()->create([
        //     'name' => 'Turkish Airlines',
        //     'iata_code' => 'TK',
        //     'icao_code' => 'THY',
        //     'callsign' => 'Turkish',
        //     'country' => 'Turkey',
        //     'operating_since' => 1933
        // ]);
        Airline::factory()->create([
            'name' => 'Emirates',
            'iata_code' => 'EK',
            'icao_code' => 'UAE',
            'callsign' => 'Emirates',
            'country' => 'United Arab Emirates',
            'operating_since' => 1985
        ]);
        // Airline::factory()->create([
        //     'name' => 'Corendon Airlines',
        //     'iata_code' => 'XC',
        //     'icao_code' => 'CAI',
        //     'callsign' => 'Corendon',
        //     'country' => 'Turkey',
        //     'operating_since' => 2004
        // ]);
        Airline::factory()->create([
            'name' => 'TUI',
            'iata_code' => 'TUI',
            'icao_code' => 'TUI',
            'callsign' => 'TUI',
            'country' => 'United Kingdom',
            'operating_since' => 2003
        ]);
        Airline::factory()->create([
            'name' => 'Transavia',
            'iata_code' => 'HV',
            'icao_code' => 'TRA',
            'callsign' => 'Transavia',
            'country' => 'Netherlands',
            'operating_since' => 1965
        ]);
        // Airline::factory()->create([
        //     'name' => 'JetNetherlands',
        //     'iata_code' => 'JN',
        //     'icao_code' => 'JNL',
        //     'callsign' => 'JetNetherlands',
        //     'country' => 'Netherlands',
        //     'operating_since' => 1997
        // ]);
        Airline::factory()->create([
            'name' => 'Martinair',
            'iata_code' => 'MP',
            'icao_code' => 'MPH',
            'callsign' => 'Martinair',
            'country' => 'Netherlands',
            'operating_since' => 1958
        ]);
    }
}
