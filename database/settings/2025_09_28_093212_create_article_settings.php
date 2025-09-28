<?php

use App\Settings\ArticleSetting;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add(ArticleSetting::group() . '.enabled', false);
        $this->migrator->add(ArticleSetting::group() . '.title', 'Writing on software design, company building, and the aerospace industry.');
        $this->migrator->add(ArticleSetting::group() . '.description', 'All of my long-form thoughts on programming, leadership, product design, and more, collected in chronological order.');
    }

    public function down(): void
    {
        $this->migrator->delete(ArticleSetting::group() . '.enabled');
        $this->migrator->delete(ArticleSetting::group() . '.title');
        $this->migrator->delete(ArticleSetting::group() . '.description');
    }
};
