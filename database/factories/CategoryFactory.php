<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomNumber(4, true),
            'count_room' => $this->faker->numberBetween(1, 3),
            'max_capacity' => $this->faker->numberBetween(1, 4),
            'conditioner' => $this->faker->boolean,
            'tv' => $this->faker->boolean,
            'smoke' => $this->faker->boolean,
            'balcony' => $this->faker->boolean,
        ];
    }
}
