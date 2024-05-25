<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Airline;
use App\Models\Airport;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departure_airport_id' => Airport::factory(),
            'arrival_airport_id' => Airport::factory(),
            'departure_time' => $this->faker->dateTimeBetween('+1 days', '+2 days'),
            'arrival_time' => $this->faker->dateTimeBetween('+2 days', '+3 days'),
            'flight_number' => $this->faker->unique()->bothify('??###'),
            'airline_id' => Airline::factory(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            // 'class' => $this->faker->randomElement(['Economy', 'Business', 'First']),
            'available_seats' => $this->faker->numberBetween(50, 300),
        ];
    }
}
