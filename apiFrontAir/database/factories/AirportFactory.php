<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city . ' International Airport',
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'iata_code' => strtoupper($this->faker->lexify('???')),
            'icao_code' => strtoupper($this->faker->lexify('????')),
            // 'terminal' => $this->faker->randomElement(['Terminal 1', 'Terminal 2', 'Terminal 3']),
            'timezone' => $this->faker->timezone,
            // 'facilities' => $this->faker->words(3, true),
            'operating_since' => $this->faker->year,
        ];
    }
}
