<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendeeRequest;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    public function index() { return Attendee::all(); }

    public function store(StoreAttendeeRequest $request)
    {
        return Attendee::create($request->validated());
    }

    public function show(Attendee $attendee) { return $attendee; }

    public function update(StoreAttendeeRequest $request, Attendee $attendee)
    {
        $attendee->update($request->validated());
        return $attendee;
    }

    public function destroy(Attendee $attendee)
    {
        $attendee->delete();
        #return response()->json(null, 204);
        return response()->json(['message' => 'Attendees Deleted successfully'], 200);
    }
}
