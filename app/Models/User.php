<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'nik',
        'avatar',
        'phone_number', 
        'address',
        'gender',
        'date_of_birth',
        'school_name',
        'club_id',
        'class_id',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date', 
    ];
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
    public function sportClass()
    {
        return $this->belongsTo(SportClass::class, 'class_id');
    }
}