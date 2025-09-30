<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'transaction_date',
        'payment_method',
        'amount',
        'discount_amount',
        'payment_proof',
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function participant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}