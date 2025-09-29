<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SocialData extends Data
{
    public function __construct(
        public string $url,
        public string $icon,
        public bool $openInNewTab,
    ) {}
}
