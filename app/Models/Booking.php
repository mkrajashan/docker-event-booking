<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['attendee_id', 'event_id'];

    public function event() { return $this->belongsTo(Event::class); }
    public function attendee() { return $this->belongsTo(Attendee::class); }
}
