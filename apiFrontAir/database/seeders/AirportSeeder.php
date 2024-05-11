<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Airport::factory(10)->create();

        // DB::table('airports')->insert([
        //     'name' => Str::random(10),
        //     'city' => Str::random(10),
        //     'country' => Str::random(10),
        //     'iata' => Str::random(3),
        //     'icao' => Str::random(4),
        //     'latitude' => rand(-90, 90),
        //     'longitude' => rand(-180, 180),
        //     'altitude' => rand(0, 10000),
        //     'timezone' => Str::random(10),
        //     'dst' => Str::random(1),
        //     'tz' => Str::random(10),
        //     'type' => Str::random(10),
        //     'source' => Str::random(10),
        // ]);
    }
}
