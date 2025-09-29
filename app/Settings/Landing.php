<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class Landing extends Settings
{
    public string $title;

    public string $description;

    public ?string $avatar;

    public static function group(): string
    {
        return 'default';
    }

    public static function disk(): string
    {
        return 'settings';
    }
}
