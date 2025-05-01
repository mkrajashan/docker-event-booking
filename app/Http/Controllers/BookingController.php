<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Booking::with(['event', 'attendee'])->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['event', 'attendee'])->find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'attendee_id' => 'required|exists:attendees,id',
            'event_id' => 'required|exists:events,id',
        ]);
    
        $event = Event::findOrFail($data['event_id']);
        if ($event->bookings()->count() >= $event->capacity) {
            return response()->json(['message' => 'Event full'], 400);
        }
    
        return Booking::firstOrCreate($data);
    }
    
    public function update(Request $request, Booking $booking) {
        return $booking;
    }
    
    public function destroy(Booking $booking) {
        $booking->delete();
        return response()->json(['message' => 'Booking Deleted successfully'], 200);
    }    
}
