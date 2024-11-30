<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    /** @use HasFactory<\Database\Factories\ExpertiseFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function lawyers()
    {
        return $this->belongsToMany(Lawyer::class, 'lawyers_expertises', 'expertiseId', 'lawyerId');
    }
}
