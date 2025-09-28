<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TechRecommendation extends Settings
{
    public bool $enabled;

    public string $title;

    public string $description;

    public ?array $technologies = null;

    public static function group(): string
    {
        return 'tech_recommendation';
    }
}
