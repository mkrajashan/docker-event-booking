<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Booking;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Country::factory(10)->create();
        \App\Models\Event::factory(20)->create();
        \App\Models\Attendee::factory(50)->create();
        \App\Models\Booking::factory(30)->create();
    }
}
