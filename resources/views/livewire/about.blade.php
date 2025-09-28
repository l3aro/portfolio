<?php

use App\Livewire\Concerns\WithSeo;
use App\Settings\About;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use App\Data\AboutWorkExperienceData;
use App\Data\AboutSkillData;
use App\Actions\GenerateCvForDownload;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Notifications\Notification;

new /**
  * @property About $about
  */ class extends Component {
    use WithSeo;
    use WithRateLimiting;

    public function mount()
    {
        if (! $this->about->enabled) {
            abort(404);
        }

        $this->seo(relativeTitle: 'About');
    }

    #[Computed]
    public function about(): About
    {
        return app(About::class);
    }

    #[Computed]
    public function workExperience()
    {
        return AboutWorkExperienceData::collect($this->about->workExperience);
    }

    #[Computed]
    public function skills()
    {
        return AboutSkillData::collect($this->about->skills);
    }

    public function download()
    {
        try {
            $this->rateLimit(maxAttempts: 1, component: 'about');
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title('Too many requests')
                ->body("Slow down! Please wait another {$exception->secondsUntilAvailable} seconds to download my CV.")
                ->warning()
                ->send();

            return;
        }

        return response()
            ->download(GenerateCvForDownload::make()->handle())
            ->deleteFileAfterSend(true);
    }
}; ?>

<x-layouts.page :title="$this->about->name" :intro="$this->about->title" breadcrumb="About">
    <x-slot name="extra">
        <flux:button wire:click="download" class="transition cursor-pointer" variant="filled">
            <div class="flex items-center gap-2">
                Download CV
                <flux:icon name="arrow-down" class="size-4" />
            </div>
        </flux:button>
    </x-slot>

    <div class="space-y-5">
        <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-400">// PERSONAL INFO</h2>
        <ul class="space-y-5 list-disc ml-6">
            @foreach ($this->about->personalInfo as $key => $value)
                <li class="text-sm text-zinc-600 dark:text-zinc-400">{{ $value }}</li>
            @endforeach
        </ul>
    </div>

    <div class="space-y-5">
        <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-400">// WORK EXPERIENCE</h2>
        <div class="space-y-10">
            @foreach ($this->workExperience as $experience)
                <x-about.work-experience :$experience />
            @endforeach
        </div>
    </div>

    <div class="space-y-5">
        <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-400">// SKILLS</h2>
        <div class="space-y-10">
            @foreach ($this->skills as $skill)
                <x-about.skill :$skill />
            @endforeach
        </div>
    </div>
</x-layouts.page>
