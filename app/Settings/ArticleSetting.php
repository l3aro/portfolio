<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ArticleSetting extends Settings
{
    public bool $enabled;

    public string $title;

    public string $description;

    public static function group(): string
    {
        return 'article';
    }
}
