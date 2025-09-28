<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AboutProjectData extends Data
{
    public function __construct(
        public string $name,
        public string $duration,
        public string $customer,
        public array $description,
        public string $teamSize,
        public string $position,
        public array $technologies,
    ) {}
}
