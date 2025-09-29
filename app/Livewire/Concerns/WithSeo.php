<?php

namespace App\Livewire\Concerns;

use App\Settings\GeneralSetting;
use Illuminate\Support\Facades\Storage;

trait WithSeo
{
    public function seo(
        ?string $absoluteTitle = null,
        ?string $relativeTitle = null,
        ?string $description = null,
        ?array $keywords = null,
    ) {
        /** @var GeneralSetting $setting */
        $setting = app(GeneralSetting::class);

        $title = $this->getSeoTitle($absoluteTitle, $relativeTitle, $setting->siteName);

        $keywords = $keywords ?? $setting->siteKeywords;

        seo()
            ->favicon()
            ->title($title)
            ->description($description ?? $setting->siteDescription)
            ->keywords(implode(',', $keywords))
            ->withUrl();

        if ($setting->siteImage) {
            seo()->image(Storage::disk(GeneralSetting::disk())->url($setting->siteImage));
        }
    }

    protected function getSeoTitle($absoluteTitle, $relativeTitle, $siteName)
    {
        if ($absoluteTitle) {
            return $absoluteTitle;
        }

        if ($relativeTitle) {
            return $relativeTitle . ' | ' . $siteName;
        }

        return $siteName;
    }
}
