<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportClass extends Model
{
    use HasFactory;

    protected $table = 'Class';


    protected $fillable = [
        'type',
        'name',
        'grade',
        'registration_fee',
        'regular_contribution_price',
        'quota_package_price',
        'number_of_attendance',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }
}