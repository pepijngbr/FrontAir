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
            'iata' => strtoupper($this->faker->lexify('???')),
            'icao' => strtoupper($this->faker->lexify('????')),
            'type' => $this->faker->randomElement(['large_airport', 'medium_airport', 'small_airport', 'seaplane_base', 'heliport', 'balloonport', 'closed']),
        ];
    }
}
