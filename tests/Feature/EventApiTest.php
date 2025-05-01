<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event;
use App\Models\User;

class EventApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_events()
    {
        Event::factory()->count(3)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200);
                 
    }
    /** @test */
    

    /** @test */
    public function unauthenticated_user_cannot_create_event()
    {
        $payload = [
            'name' => 'Conference',
            'date' => '2025-01-01 10:00:00',
            'location_id' => 1,
            'capacity' => 200
        ];

        $response = $this->postJson('/api/events', $payload);

        $response->assertStatus(401);
    }

    /** @test */
    /*public function authenticated_user_can_delete_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')
                         ->deleteJson("/api/events/{$event->id}");

        $response->assertStatus(200);
    }*/
}
