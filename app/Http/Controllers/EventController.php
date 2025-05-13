<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{

    public function index() { 
        return Event::with('location')->get(); 
    
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create(array_merge(
        $request->validated(),
        ['user_id' => Auth::id()]
    ));

    return response()->json($event, 201);
    }

    public function show(Event $event) { 
        return $event->load('location'); }

    public function update(UpdateEventRequest $request, Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $event->update(attributes: $request->validated());
        return $event;
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        
        $event->delete();
        return response()->json(['message' => 'Event Deleted successfully'], 200);
    }
}