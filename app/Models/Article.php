<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
    use SoftDeletes;
    use HasTags;

    protected $fillable = [
        'title',
        'description',
        'content',
        'published_at',
    ];
}
