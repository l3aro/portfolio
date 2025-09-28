<?php

use App\Settings\About;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add(About::group() . '.enabled', false);
        $this->migrator->add(About::group() . '.name', '');
        $this->migrator->add(About::group() . '.title', '');
        $this->migrator->add(About::group() . '.personalInfo', []);
        $this->migrator->add(About::group() . '.careerObjective', '');
        $this->migrator->add(About::group() . '.workExperience', []);
        $this->migrator->add(About::group() . '.projects', []);
        $this->migrator->add(About::group() . '.skills', []);
        $this->migrator->add(About::group() . '.educations', []);
    }

    public function down(): void
    {
        $this->migrator->delete(About::group() . '.enabled');
        $this->migrator->delete(About::group() . '.name');
        $this->migrator->delete(About::group() . '.title');
        $this->migrator->delete(About::group() . '.personalInfo');
        $this->migrator->delete(About::group() . '.careerObjective');
        $this->migrator->delete(About::group() . '.workExperience');
        $this->migrator->delete(About::group() . '.projects');
        $this->migrator->delete(About::group() . '.skills');
        $this->migrator->delete(About::group() . '.educations');
    }
};
