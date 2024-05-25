<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DepartureGate;

class DepartureGateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DepartureGate::factory()->count(10)->create();
    }
}
