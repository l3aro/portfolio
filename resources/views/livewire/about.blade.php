<?php

use App\Livewire\Concerns\WithSeo;
use App\Settings\About;
use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use App\Data\AboutWorkExperienceData;
use App\Data\AboutSkillData;

new
/**
 * @property About $about
 */
class extends Component {
    use WithSeo;

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
}; ?>

<x-layouts.page :title="$this->about->name" :intro="$this->about->title" breadcrumb="About">
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
