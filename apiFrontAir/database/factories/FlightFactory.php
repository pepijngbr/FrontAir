<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;

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
        // Get a random airline
        $airlineId = rand(1, Airline::count());
        $airline = Airline::find($airlineId);

        // Generate flight number
        $flightNumber = $this->generateFlightNumber($airline->name);

        return [
            'departure_airport_id' => Airport::factory(),
            'arrival_airport_id' => Airport::factory(),
            'departure_time' => $this->faker->dateTimeBetween('+1 days', '+2 days'),
            'arrival_time' => $this->faker->dateTimeBetween('+2 days', '+3 days'),
            'flight_number' => $flightNumber,
            'airline_id' => $airlineId,
            'image' => rand(1, 8),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'available_seats' => $this->faker->numberBetween(50, 300),
        ];
    }

    /**
     * Generate a flight number based on the airline name.
     *
     * @param string $airlineName
     * @return string
     */
    function generateFlightNumber($airlineName)
    {
        // Generate a 2-letter abbreviation from the airline name, in uppercase and keep the first 2 letters
        $abbreviation = strtoupper(substr($airlineName, 0, 2));

        // Generate a unique 4-digit number
        do {
            $uniqueNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $flightNumber = $abbreviation . $uniqueNumber;

            // Check if this flight number already exists in the database
            $exists = Flight::where('flight_number', $flightNumber)->exists();
        } while ($exists);

        return $flightNumber;
    }
}
