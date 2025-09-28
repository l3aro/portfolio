<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class About extends Settings
{
    public bool $enabled;

    public string $name;

    public string $title;

    public array $personalInfo;

    public string $careerObjective;

    public array $workExperience;

    public array $projects;

    public array $skills;

    public array $educations;

    public static function group(): string
    {
        return 'about';
    }
}
