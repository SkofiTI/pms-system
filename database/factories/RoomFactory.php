<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => $this->faker->unique()->numberBetween(100, 500),
            'category_id' => Category::pluck('category_id')->random(),
            'floor' => $this->faker->numberBetween(1, 4),
            'square' => $this->faker->numberBetween(20, 100),
        ];
    }
}
