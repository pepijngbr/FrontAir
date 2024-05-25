<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Baggage;

class BaggageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Baggage::factory()->count(100)->create();
    }
}
