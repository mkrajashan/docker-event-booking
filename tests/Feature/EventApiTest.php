<?php
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_events()
    {
        Event::factory()->count(5)->create();
        $response = $this->getJson('/api/events');
        $response->assertStatus(200)->assertJsonCount(5);
    }

    public function test_authenticated_user_can_create_event()
    {
        $user = User::factory()->create();
        $location = \App\Models\Location::factory()->create();

        $payload = [
            'name' => 'Test Event',
            'description' => 'Test description',
            'location_id' => $location->id,
            'date' => now()->addDays(10)->format('Y-m-d H:i:s'),
            'capacity' => 100,
        ];

        $response = $this->actingAs($user)->postJson('/api/events', $payload);
        $response->assertStatus(201)->assertJsonFragment(['name' => 'Test Event']);
    }

    public function test_unauthenticated_user_cannot_create_event()
    {
        $location = \App\Models\Location::factory()->create();
        $payload = [
            'name' => 'Unauthorized Event',
            'description' => 'Description',
            'location_id' => $location->id,
            'date' => now()->addDays(10)->format('Y-m-d H:i:s'),
            'capacity' => 50,
        ];

        $response = $this->postJson('/api/events', $payload);
        $response->assertStatus(401); // Unauthorized
    }

    public function test_invalid_event_data_fails_validation()
    {
        $user = User::factory()->create();

        $payload = [
            'name' => '',
            'capacity' => -10,
            'location_id' => null,
            'date' => 'not-a-date',
        ];

        $response = $this->actingAs($user)->postJson('/api/events', $payload);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'capacity', 'location_id', 'date']);
    }

    public function test_user_can_update_own_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->putJson("/api/events/{$event->id}", [
            'name' => 'Updated Name',
            'description' => 'Updated desc',
            'location_id' => $event->location_id,
            'capacity' => 200,
            'date' => $event->date->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(200)->assertJsonFragment(['name' => 'Updated Name']);
    }

    public function test_user_cannot_update_others_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(); // Created by someone else

        $response = $this->actingAs($user)->putJson("/api/events/{$event->id}", [
            'name' => 'Malicious Update',
            'location_id' => $event->location_id,
            'capacity' => 999,
            'date' => $event->date->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(403);
    }
}
