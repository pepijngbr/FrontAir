<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Flight;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, count(User::all())),
            'flight_id' => Flight::factory(),
            'booking_date' => now(),
            'seat_number' => $this->faker->unique()->numberBetween(1, 300),
            'class' => $this->faker->randomElement(['Economy', 'Business', 'First']),
            'type' => $this->faker->randomElement(['one-way', 'round-trip']),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'booking_status' => $this->faker->randomElement(['booked', 'pending']),
        ];
    }
}
