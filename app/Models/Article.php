<?php

namespace App\Models;

use App\Models\Contracts\HasUrl;
use App\Models\Concerns\InteractsWithUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\Tags\HasTags;

/**
 * @property string $title
 * @property ?string $description
 * @property ?string $content
 * @property Carbon $published_at
 */
class Article extends Model implements HasUrl
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
    use SoftDeletes;
    use HasTags;
    use InteractsWithUrl;

    protected $fillable = [
        'title',
        'description',
        'content',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'immutable_datetime',
    ];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBreadcrumbs(): array
    {
        return [
            ['title' => $this->getTitle(), 'url' => $this->url()],
        ];
    }
}
