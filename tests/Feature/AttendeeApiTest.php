<?php

namespace Tests\Feature;

use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AttendeeApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_attendee_with_valid_data()
    {
    
        $response = $this->postJson('/api/attendees', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $response->assertCreated()
                 ->assertJsonFragment(['name' => 'Jane Doe']);
    }

    public function test_create_attendee_with_missing_fields()
    {
        $response = $this->postJson('/api/attendees', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email']);
    }

    public function test_update_attendee_info()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->putJson("/api/attendees/{$attendee->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $response->assertOk()
                 ->assertJsonFragment(['name' => 'Updated Name']);
    }

    public function test_delete_attendee()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->deleteJson("/api/attendees/{$attendee->id}");

        $response->assertNoContent();
    }
}
