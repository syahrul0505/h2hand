<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_registration_date',
        'end_registration_date',
        'date_technical',
        'date_of_competition',
        'location',
        'location_link',
        'status',
        'max_people',
        'image',
    ];

    protected $casts = [
        'start_registration_date' => 'date',
        'end_registration_date' => 'date',
        'date_technical' => 'date',
         'date_of_competition' => 'date',
    ];

    public function participants()
    {
        return $this->hasManyThrough(RegistrationEventClub::class, RegistrationEvent::class);
    }

    public function registrationEvents()
    {
        return $this->hasMany(RegistrationEvent::class);
    }
}