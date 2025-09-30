<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'total',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function details()
    {
        return $this->hasMany(RegistrationEventDetail::class);
    }

    public function participants()
    {
        return $this->hasMany(RegistrationEventClub::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

      public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}