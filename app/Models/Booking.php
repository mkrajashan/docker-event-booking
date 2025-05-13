<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    //protected $fillable = ['event_id', 'attendee_id', 'user_id'];
    protected $fillable = ['event_id', 'attendee_id'];

    public function event() { return $this->belongsTo(Event::class); }
    public function attendee() { return $this->belongsTo(Attendee::class); }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
