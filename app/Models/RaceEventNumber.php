<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceEventNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'max_participants',
        'category_event',
        'age_category',
        'max_age',
        'class_category',
    ];
}