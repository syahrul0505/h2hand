<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expenses extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'date',
        'description'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d', 
        'amount' => 'decimal:0' 
    ];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace('.', '', $value);
    }
}
