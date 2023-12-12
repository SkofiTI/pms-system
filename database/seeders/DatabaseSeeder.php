<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()
            ->count(4)
            ->create();

        Room::factory()
            ->count(15)
            ->create();

        Reservation::factory()
            ->count(15)
            ->create();

        Guest::factory()
            ->count(15)
            ->create();
    }
}
