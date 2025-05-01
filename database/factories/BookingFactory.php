<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition()
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'attendee_id' => \App\Models\Attendee::factory(),
        ];
    }
}
