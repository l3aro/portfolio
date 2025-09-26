<?php

namespace App\Models\Concerns;

use App\Actions\GenerateUrl;
use App\Models\Url;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property-read ?Url $url
 */
trait InteractsWithUrl
{
    public const MORPH_NAME = 'urlable';

    public static function bootInteractsWithUrl(): void
    {
        static::created(fn(self $model) => GenerateUrl::make()->handle($model));

        static::forceDeleted(fn(self $model) => $model->url()->delete());
    }

    public function url(): MorphOne
    {
        return $this->morphOne(Url::class, static::MORPH_NAME);
    }
}
