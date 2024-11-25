<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    public function comments(): HasMany{
        return $this->hasMany(Course::class);
    }

    public function writer(): BelongsTo{
        return $this->belongsTo(Lawyer::class, id, lawyerId);
    }
}
