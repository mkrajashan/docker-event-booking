<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location_id', 'country_id','date', 'capacity', 'user_id'];

    public function location() { return $this->belongsTo(Location::class); }
    public function bookings() { return $this->hasMany(Booking::class); }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
