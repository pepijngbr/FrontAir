<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Baggage>
 */
class BaggageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'flight_id' => Flight::factory(),
            'ticket_id' => Ticket::factory(),
            'weight' => $this->faker->randomFloat(2, 5, 30),
            'status' => $this->faker->randomElement(['checked-in', 'in-transit', 'delivered']),
        ];
    }
}
