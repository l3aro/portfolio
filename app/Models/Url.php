<?php

namespace App\Models;

use App\Models\Contracts\HasUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $slug
 *
 * @property-read HasUrl $urlable
 */
class Url extends Model
{
    public const SEPARATOR = '-';

    protected $fillable = [
        'slug',
    ];

    public function urlable(): MorphTo
    {
        return $this->morphTo();
    }
}
