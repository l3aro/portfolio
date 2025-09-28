<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AboutEducationData extends Data
{
    public function __construct(
        public string $institution,
        public string $major,
        public string $duration,
    ) {}
}
