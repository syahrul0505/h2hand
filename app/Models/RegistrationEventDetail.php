<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationEventDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_event_id',
        'registration_event_club_id',
        'race_event_number_id',
        'name',
        'price',
        'seri',
        'lintasan',
        'waktu_mulai',
        'hasil',
        'status',
        'posisi',
    ];

    public function registrationEvent()
    {
        return $this->belongsTo(RegistrationEvent::class);
    }

    public function raceEventNumber()
    {
        return $this->belongsTo(RaceEventNumber::class);
    }

    public function participant()
    {
        return $this->belongsTo(RegistrationEventClub::class, 'registration_event_club_id');
    }
}