<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateIn = $this->faker->dateTimeBetween('now', '+4 months');
        $dateOut = $this->faker->dateTimeBetween($dateIn, $dateIn->format('Y-m-d').' +3 weeks');

        return [
            'room_id' => Room::pluck('room_id')->random(),
            'date_in' => $dateIn,
            'date_out' => $dateOut,
            'status' => $this->faker->randomElement(['booked', 'dirty']),
        ];
    }
}
