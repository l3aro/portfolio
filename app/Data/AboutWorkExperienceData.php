<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AboutWorkExperienceData extends Data
{
    public function __construct(
        public string $company,
        public string $role,
        public string $duration,
        public array $responsibilities,
    ) {}
}
