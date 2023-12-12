<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reserv_id' => Reservation::pluck('reserv_id')->random(),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'patronymic' => $this->faker->optional()->firstNameMale,
            'address' => $this->faker->address,
            'number' => $this->faker->phoneNumber,
            'passport' => $this->faker->randomNumber(8),
        ];
    }
}
