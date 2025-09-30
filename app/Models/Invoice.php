<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'invoice_number',
        'registration_event_id',
        'club_id',
        'payment_date',
        'due_date',
        'total_amount',
        'discount',
        'paid_amount',
        'status',
    ];
 protected $casts = [
        'payment_date' => 'date',
        'due_date' => 'date',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class); 
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
    
    public function registrationEvent()
    {
        return $this->belongsTo(RegistrationEvent::class);
    }
}