<?php

namespace Tests\Feature;

use App\Models\{User, Booking, Event, Attendee};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_booking()
    {
        Sanctum::actingAs(User::factory()->create());

        $event = Event::factory()->create(['capacity' => 10]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'attendee_id' => $attendee->id,
            'event_id' => $event->id,
        ]);

        $response->assertCreated()
                 ->assertJsonFragment(['event_id' => $event->id]);
    }

    public function test_authenticated_user_can_delete_booking()
    {
        Sanctum::actingAs(User::factory()->create());

        $event = Event::factory()->create();
        $attendee = Attendee::factory()->create();

        $booking = Booking::factory()->create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response = $this->deleteJson("/api/bookings/{$booking->id}");

        $response->assertNoContent();
    }

    public function test_authenticated_user_can_view_booking()
    {
        Sanctum::actingAs(User::factory()->create());

        $event = Event::factory()->create();
        $attendee = Attendee::factory()->create();

        $booking = Booking::factory()->create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response = $this->getJson("/api/bookings/{$booking->id}");

        $response->assertOk()
                 ->assertJsonFragment(['id' => $booking->id]);
    }

    public function test_guest_user_can_create_booking()
    {
        $event = Event::factory()->create(['capacity' => 10]);
        $attendee = Attendee::factory()->create();
    
        $response = $this->postJson('/api/bookings', [
            'attendee_id' => $attendee->id,
            'event_id' => $event->id,
        ]);
    
        $response->assertCreated()
                 ->assertJsonFragment(['event_id' => $event->id]);
    }

    public function test_guest_user_cannot_delete_booking()
    {
        $event = Event::factory()->create();
        $attendee = Attendee::factory()->create();
        $booking = Booking::factory()->create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response = $this->deleteJson("/api/bookings/{$booking->id}");

        $response->assertUnauthorized();
    }

    public function test_guest_user_cannot_view_booking()
    {
        $event = Event::factory()->create();
        $attendee = Attendee::factory()->create();
        $booking = Booking::factory()->create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response = $this->getJson("/api/bookings/{$booking->id}");

        $response->assertUnauthorized();
    }
}
