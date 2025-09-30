<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jersey extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'show_on_registration_form',
        'back_number',
        'back_name',
        'image', 
    ];
}