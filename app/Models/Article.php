<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'imagePath',
        'createDate',
        'lawyer_id',
        'expertise_id',
    ];

    public function expertise()
    {
        return $this->belongsTo(Expertise::class, 'expertise_id', 'id');
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }
}
