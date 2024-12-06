<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'lawyer_id',
        'user_id',
        'dateTime',
        'address',
        'status',
        'rating',
        'review',
    ];

    protected $casts = [
        'dateTime' => 'datetime',
    ];

}
