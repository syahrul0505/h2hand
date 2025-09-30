<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationEventClub extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_event_id',
        'club',
        'name',
        'gender',
        'date_of_birth',
        'school',
        'class',
        'coach_name',
        'phone',
    ];

    public function registrationEvent()
    {
        return $this->belongsTo(RegistrationEvent::class);
    }
    public function details()
    {
        return $this->hasMany(RegistrationEventDetail::class);
    }
}