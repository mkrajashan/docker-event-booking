<?php

use App\Http\Controllers\{AuthController, EventController, BookingController, AttendeeController, LocationController};
use Illuminate\Support\Facades\Route;

// Public auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public events & attendees
Route::apiResource('events', EventController::class)->only(['index', 'show']);
Route::apiResource('attendees', AttendeeController::class);

// Public booking: create only
Route::post('/bookings', [BookingController::class, 'store']);

Route::apiResource('locations', LocationController::class);

// Authenticated routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Full event management (auth)
    Route::apiResource('events', EventController::class)->only(['store', 'update', 'destroy']);
    
    // Manage bookings (auth)
    Route::apiResource('bookings', BookingController::class)->only(['index', 'show', 'destroy','update']);
});