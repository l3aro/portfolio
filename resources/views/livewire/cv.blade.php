<?php

use App\Settings\About;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use App\Data\AboutWorkExperienceData;
use App\Data\AboutSkillData;
use App\Data\AboutProjectData;
use App\Data\AboutEducationData;
use App\Settings\GeneralSetting;
use Illuminate\Support\Facades\Storage;

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

    #[Computed]
    public function generalSetting()
    {
        return app(GeneralSetting::class);
    }
}; ?>

<div class="mx-auto max-w-5xl px-6 py-8 sm:px-8 sm:py-10 print:max-w-none print:p-0 print:px-8 print:py-0">

    {{-- Print Button (screen only) --}}
    <div class="flex justify-end mb-6 print:hidden">
        <button
            onclick="window.print()"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900 transition-colors"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print / Download PDF
        </button>
    </div>

    {{-- Header --}}
    <header class="print:pt-2">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-50 via-white to-zinc-50 dark:from-indigo-950/40 dark:via-zinc-900 dark:to-zinc-900 border border-zinc-200/60 dark:border-zinc-700/40 print:border-none print:bg-none print:bg-white print:rounded-none">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-100/40 via-transparent to-transparent dark:from-indigo-900/20 print:hidden"></div>
            <div class="relative px-6 py-8 sm:px-8 sm:py-10 print:px-0 print:py-4 print:pb-3">
                <div class="flex justify-between items-start">
                    {{-- Left: Avatar + Name + Title --}}
                    <div class="flex gap-4 sm:gap-5 items-center">
                        @if (str($this->generalSetting->siteLogo)->isNotEmpty())
                            <div class="flex-shrink-0">
                                <div class="relative">
                                    <div class="absolute -inset-1 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 opacity-75 blur-sm print:hidden"></div>
                                    <img
                                        src="{{ Storage::disk($this->generalSetting->disk())->url($this->generalSetting->siteLogo) }}"
                                        alt="Avatar"
                                        class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-full ring-4 ring-white dark:ring-zinc-800 shadow-lg print:ring-2 print:shadow-none print:w-20 print:h-20"
                                    />
                                </div>
                            </div>
                        @endif

                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-zinc-900 dark:text-white print:text-2xl">
                                {{ $this->about->name }}
                            </h1>
                            <p class="mt-1.5 text-lg text-indigo-600 dark:text-indigo-400 font-medium print:text-base print:text-indigo-700">
                                {{ $this->about->title }}
                            </p>
                        </div>
                    </div>

                    {{-- Right: Contact Info --}}
                    @if (count($this->about->personalInfo) > 0)
                        <div class="hidden sm:flex flex-col items-end space-y-2 pt-2">
                            <ul class="space-y-2 flex flex-col items-end">
                                @foreach ($this->about->personalInfo as $key => $value)
                                    <li class="flex items-center gap-1.5 text-sm text-zinc-600 dark:text-zinc-400 print:text-xs print:text-zinc-500">
                                        @if (str($value)->contains('@'))
                                            <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        @elseif (preg_match('/^[\+]?[\d\s\-\(\)]+$/', $value))
                                            <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        @elseif (str($value)->contains('http') || str($value)->contains('www') || str($value)->contains('.com') || str($value)->contains('.dev') || str($value)->contains('.io'))
                                            <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                        @else
                                            <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        @endif
                                        <span class="truncate">{{ $value }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Bottom: Career Objective --}}
                @if (str($this->about->careerObjective)->isNotEmpty())
                    <div class="mt-5 pt-4 border-t border-zinc-200/60 dark:border-zinc-700/40 print:mt-3 print:pt-2 print:border-zinc-200">
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed print:text-xs">
                            {{ $this->about->careerObjective }}
                        </p>
                    </div>
                @endif

                {{-- Mobile: Contact Info (shown only on small screens) --}}
                @if (count($this->about->personalInfo) > 0)
                    <div class="mt-5 pt-4 border-t border-zinc-200/60 dark:border-zinc-700/40 sm:hidden print:mt-3 print:pt-2 print:border-zinc-200">
                        <ul class="flex flex-wrap gap-x-5 gap-y-1.5">
                            @foreach ($this->about->personalInfo as $key => $value)
                                <li class="flex items-center gap-1.5 text-sm text-zinc-600 dark:text-zinc-400 print:text-xs print:text-zinc-500">
                                    @if (str($value)->contains('@'))
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @elseif (preg_match('/^[\+]?[\d\s\-\(\)]+$/', $value))
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    @elseif (str($value)->contains('http') || str($value)->contains('www') || str($value)->contains('.com') || str($value)->contains('.dev') || str($value)->contains('.io'))
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                    @else
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0 print:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    @endif
                                    <span class="truncate">{{ $value }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <div class="mt-8 sm:mt-10 print:mt-5 space-y-8 print:space-y-6">

        {{-- Work Experience --}}
        @if (count($this->workExperience) > 0)
            <section class="break-inside-avoid">
                <div class="flex items-center gap-3 mb-5 print:mb-4">
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-indigo-600/30"></div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 print:text-indigo-700">
                        Work Experience
                    </h2>
                    <div class="h-px flex-1 bg-gradient-to-l from-indigo-500/30 to-transparent print:from-indigo-600/30"></div>
                </div>
                <div class="space-y-6 print:space-y-4">
                    @foreach ($this->workExperience as $experience)
                        <x-about.work-experience :$experience />
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Projects --}}
        @if (count($this->projects) > 0)
            <section class="break-inside-avoid">
                <div class="flex items-center gap-3 mb-5 print:mb-4">
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-indigo-600/30"></div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 print:text-indigo-700">
                        Projects
                    </h2>
                    <div class="h-px flex-1 bg-gradient-to-l from-indigo-500/30 to-transparent print:from-indigo-600/30"></div>
                </div>
                <div class="space-y-6 print:space-y-4">
                    @foreach ($this->projects as $project)
                        <x-cv.project :$project />
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Skills & Education (two columns) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 print:gap-6">
            @if (count($this->skills) > 0)
                <section class="break-inside-avoid">
                    <div class="flex items-center gap-3 mb-5 print:mb-4">
                        <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-indigo-600/30"></div>
                        <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 print:text-indigo-700">
                            Skills
                        </h2>
                    </div>
                    <div class="space-y-4 print:space-y-3">
                        @foreach ($this->skills as $skill)
                            <x-cv.skill :$skill />
                        @endforeach
                    </div>
                </section>
            @endif

            @if (count($this->educations) > 0)
                <section class="break-inside-avoid">
                    <div class="flex items-center gap-3 mb-5 print:mb-4">
                        <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-indigo-600/30"></div>
                        <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 print:text-indigo-700">
                            Education
                        </h2>
                    </div>
                    <div class="space-y-4 print:space-y-3">
                        @foreach ($this->educations as $education)
                            <x-cv.education :$education />
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</div>
