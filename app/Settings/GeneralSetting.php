<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public string $siteName;
    public string $siteDescription;
    public ?array $siteKeywords;
    public ?string $siteLogo;
    public ?string $siteImage;
    public ?string $googleAnalyticsKey;
    public ?array $socials;

    public static function group(): string
    {
        return 'general';
    }

    public static function disk(): string
    {
        return 'settings';
    }
}
