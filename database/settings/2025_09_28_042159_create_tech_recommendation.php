<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
use App\Settings\TechRecommendation;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add(TechRecommendation::group() . '.enabled', false);
        $this->migrator->add(TechRecommendation::group() . '.technologies', []);
        $this->migrator->add(TechRecommendation::group() . '.title', 'Software I use, gadgets I love, and other things I recommend.');
        $this->migrator->add(TechRecommendation::group() . '.description', "I get asked a lot about the things I use to build software, stay productive, or buy to fool myself into thinking I'm being productive when I'm really just procrastinating. Here's a big list of all of my favorite stuff.");
    }

    public function down(): void
    {
        $this->migrator->delete(TechRecommendation::group() . '.enabled');
        $this->migrator->delete(TechRecommendation::group() . '.technologies');
        $this->migrator->delete(TechRecommendation::group() . '.title');
        $this->migrator->delete(TechRecommendation::group() . '.description');
    }
};
