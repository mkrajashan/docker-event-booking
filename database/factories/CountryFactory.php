<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->country,
            'code' => $this->faker->countryCode,
        ];
    }
}