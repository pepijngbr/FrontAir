<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Airport;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DepartureGate>
 */
class DepartureGateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gate_number' => $this->faker->randomElement(['A1', 'A2', 'B1', 'B2']),
            'airport_id' => Airport::factory(),
            'departure_time' => $this->faker->dateTimeBetween('+1 days', '+2 days'),
            'boarding_status' => $this->faker->randomElement(['boarding', 'closed', 'delayed']),
        ];
    }
}
