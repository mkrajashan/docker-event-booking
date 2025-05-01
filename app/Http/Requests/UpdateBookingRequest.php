<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'event_id' => 'sometimes|required|exists:events,id',
            'attendee_id' => 'sometimes|required|exists:attendees,id',
        ];
    }
}
