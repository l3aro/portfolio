<?php

use App\Settings\Landing;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add(Landing::group() . '.title', '');
        $this->migrator->add(Landing::group() . '.description', '');
        $this->migrator->add(Landing::group() . '.avatar', null);
    }

    public function down(): void
    {
        $this->migrator->delete(Landing::group() . '.title');
        $this->migrator->delete(Landing::group() . '.description');
        $this->migrator->delete(Landing::group() . '.avatar');
    }
};
