<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Location;

class LocationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_locations()
    {
        Location::factory()->count(3)->create();

        $response = $this->getJson('/api/locations');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_create_location()
    {
        $payload = [
            'name' => 'Test City',
        ];

        $response = $this->postJson('/api/locations', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment($payload);

        $this->assertDatabaseHas('locations', $payload);
    }

    public function test_create_location_validation()
    {
        $response = $this->postJson('/api/locations', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('name');
    }
}
