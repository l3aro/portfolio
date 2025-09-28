<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AboutSkillData extends Data
{
    public function __construct(
        public string $type,
        public array $skill,
    ) {}
}
