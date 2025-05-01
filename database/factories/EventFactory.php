<?php
namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'date' => $this->faker->dateTime,
            'location_id' => Location::factory(),
            'capacity' => 100,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
