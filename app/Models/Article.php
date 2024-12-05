<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    // public function comments() {
    //     return $this->hasMany(Course::class);
    // }

    // public function writer() {
    //     return $this->belongsTo(Lawyer::class, id, lawyerId);
    // }
    public function expertise() {
        return $this->belongsTo(Expertise::class, 'expertise_id', 'id');
    }
}
