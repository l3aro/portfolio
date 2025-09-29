<?php

use App\Settings\GeneralSetting;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add(GeneralSetting::group() . '.siteName', 'l3aro');
        $this->migrator->add(GeneralSetting::group() . '.siteDescription', 'A personal portfolio website showcasing my skills and projects as a full-stack web developer.');
        $this->migrator->add(GeneralSetting::group() . '.siteKeywords', ['l3aro', 'portfolio', 'web developer', 'full-stack', 'Laravel', 'PHP', 'JavaScript', 'CSS', 'HTML']);
        $this->migrator->add(GeneralSetting::group() . '.siteLogo', '');
        $this->migrator->add(GeneralSetting::group() . '.siteImage', '');
        $this->migrator->add(GeneralSetting::group() . '.googleAnalyticsKey', '');
        $this->migrator->add(GeneralSetting::group() . '.socials', []);
    }

    public function down(): void
    {
        $this->migrator->delete(GeneralSetting::group() . '.siteName');
        $this->migrator->delete(GeneralSetting::group() . '.siteDescription');
        $this->migrator->delete(GeneralSetting::group() . '.siteKeywords');
        $this->migrator->delete(GeneralSetting::group() . '.siteLogo');
        $this->migrator->delete(GeneralSetting::group() . '.siteImage');
        $this->migrator->delete(GeneralSetting::group() . '.googleAnalyticsKey');
        $this->migrator->delete(GeneralSetting::group() . '.socials');
    }
};
