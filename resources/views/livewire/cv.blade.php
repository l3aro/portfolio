<?php

use App\Settings\About;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use App\Data\AboutWorkExperienceData;
use App\Data\AboutSkillData;
use App\Data\AboutProjectData;
use App\Data\AboutEducationData;

new #[Layout('components.layouts.simple')] class extends Component {
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
    public function projects()
    {
        return AboutProjectData::collect($this->about->projects);
    }

    #[Computed]
    public function skills()
    {
        return AboutSkillData::collect($this->about->skills);
    }

    #[Computed]
    public function educations()
    {
        return AboutEducationData::collect($this->about->educations);
    }
}; ?>

<div class="mx-auto max-w-3xl">
    <div class="mt-16">
        <header class="flex justify-between items-start">
            <div class="flex gap-4 items-center">
                <img src="{{ asset('images/avatar.jpg') }}" alt="Avatar" class="w-32 h-32 rounded-full shadow" />
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-zinc-800 sm:text-4xl dark:text-zinc-100">
                        {{ $this->about->name }}
                    </h1>
                    <p class="mt-2 text-base text-zinc-600 dark:text-zinc-400">
                        {{ $this->about->title }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col items-end space-y-3 pt-2">
                <ul class="space-y-2 flex flex-col items-end">
                    @foreach ($this->about->personalInfo as $key => $value)
                        <li class="text-sm text-zinc-600 dark:text-zinc-400">{{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        </header>
    </div>

    <div class="mt-16 sm:mt-20 space-y-20">
        <div class="space-y-5">
            <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-400">// CAREER OBJECTIVE</h2>
            <p class="text-base text-zinc-600 dark:text-zinc-400">{{ $this->about->careerObjective }}</p>
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
            <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-400">// PROJECTS</h2>
            <div class="space-y-10">
                @foreach ($this->projects as $project)
                    <x-cv.project :$project />
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-2">
            <div class="space-y-5">
                <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-400">// SKILLS</h2>
                <div class="space-y-10">
                    @foreach ($this->skills as $skill)
                        <x-cv.skill :$skill />
                    @endforeach
                </div>
            </div>
            <div class="space-y-5">
                <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-400">// EDUCATION</h2>
                <div class="space-y-10">
                    @foreach ($this->educations as $education)
                        <x-cv.education :$education />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
