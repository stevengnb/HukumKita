<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lawyer extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\LawyerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'gender',
        'dob',
        'password',
        'education',
        'address',
        'experience',
        'rate',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
