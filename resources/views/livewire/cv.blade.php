<?php

use App\Actions\GenerateCvForDownload;
use App\Settings\About;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Notifications\Notification;
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
    use WithRateLimiting;

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

    public function download()
    {
        try {
            $this->rateLimit(maxAttempts: 1, component: 'cv');
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

{{-- Custom Styles & Animations --}}
<style>
    .cv-page html, .cv-page body { scroll-behavior: smooth; }

    @keyframes cv-fade-up {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .cv-item {
        animation: cv-fade-up 0.5s ease-out both;
    }

    .cv-section {
        scroll-margin-top: 2rem;
    }

    @media (prefers-reduced-motion: reduce) {
        .cv-item {
            animation: none;
        }
    }

    @media print {
        .cv-item {
            animation: none;
            opacity: 1;
            transform: none;
        }
        @page {
            margin: 1.5cm 2cm;
            size: A4;
        }
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<div class="cv-page mx-auto max-w-5xl px-6 py-8 sm:px-8 sm:py-10 print:max-w-none print:p-0 print:px-6 print:py-0 bg-[#faf8f5] dark:bg-zinc-900 print:bg-white">
    {{-- Header --}}
    <header class="print:pt-2" id="top">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-50/80 via-white to-zinc-50/80 dark:from-indigo-950/40 dark:via-zinc-900 dark:to-zinc-900/80 border border-zinc-200/60 dark:border-zinc-700/40 print:border-none print:bg-none print:bg-white print:rounded-none">
            {{-- Gradient Mesh (screen only) --}}
            <div class="absolute inset-0 print:hidden" style="background-image: radial-gradient(at 30% 20%, rgba(99, 102, 241, 0.08) 0px, transparent 50%), radial-gradient(at 70% 60%, rgba(129, 140, 248, 0.06) 0px, transparent 50%), radial-gradient(at 90% 10%, rgba(79, 70, 229, 0.04) 0px, transparent 50%);"></div>

            <div class="relative px-6 py-8 sm:px-8 sm:py-10 print:px-0 print:py-4 print:pb-3">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                    {{-- Left: Avatar + Name + Title --}}
                    <div class="flex gap-4 sm:gap-5 items-center">
                        @if (str($this->generalSetting->siteLogo)->isNotEmpty())
                            <div class="flex-shrink-0">
                                <div class="relative">
                                    <div class="absolute -inset-1.5 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 opacity-60 blur-sm print:hidden"></div>
                                    <div class="absolute -inset-3 rounded-full bg-indigo-500/10 print:hidden"></div>
                                    <img
                                        src="{{ Storage::disk($this->generalSetting->disk())->url($this->generalSetting->siteLogo) }}"
                                        alt="Avatar"
                                        class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-full ring-4 ring-white dark:ring-zinc-800 shadow-lg print:ring-1 print:shadow-none print:w-20 print:h-20"
                                    />
                                </div>
                            </div>
                        @endif

                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-zinc-900 dark:text-white print:text-2xl print:tracking-normal">
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
                                        <span class="truncate max-w-[200px]">{{ $value }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Career Objective as Pull-Quote --}}
                @if (str($this->about->careerObjective)->isNotEmpty())
                    <div class="mt-5 pt-4 border-t border-zinc-200/60 dark:border-zinc-700/40 print:mt-3 print:pt-2 print:border-zinc-200">
                        <blockquote class="relative pl-4 border-l-2 border-indigo-400 dark:border-indigo-500 print:border-l print:border-indigo-600">
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed italic print:text-xs print:not-italic">
                                {{ $this->about->careerObjective }}
                            </p>
                        </blockquote>
                    </div>
                @endif

                {{-- Mobile: Contact Info --}}
                @if (count($this->about->personalInfo) > 0)
                    <div class="mt-5 pt-4 border-t border-zinc-200/60 dark:border-zinc-700/40 sm:hidden print:hidden">
                        <ul class="flex flex-wrap gap-x-5 gap-y-1.5">
                            @foreach ($this->about->personalInfo as $key => $value)
                                <li class="flex items-center gap-1.5 text-sm text-zinc-600 dark:text-zinc-400">
                                    @if (str($value)->contains('@'))
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @elseif (preg_match('/^[\+]?[\d\s\-\(\)]+$/', $value))
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    @elseif (str($value)->contains('http') || str($value)->contains('www') || str($value)->contains('.com') || str($value)->contains('.dev') || str($value)->contains('.io'))
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                    @else
                                        <svg class="w-3.5 h-3.5 text-indigo-500 dark:text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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

    {{-- Sticky Section Index (screen only, desktop) --}}
    @php
        $cvSections = [];
        if (count($this->workExperience) > 0) $cvSections[] = ['id' => 'experience', 'label' => 'Experience'];
        if (count($this->projects) > 0) $cvSections[] = ['id' => 'projects', 'label' => 'Projects'];
        if (count($this->skills) > 0) $cvSections[] = ['id' => 'skills', 'label' => 'Skills'];
        if (count($this->educations) > 0) $cvSections[] = ['id' => 'education', 'label' => 'Education'];
    @endphp
    @if (count($cvSections) > 1)
    <nav class="fixed right-4 top-1/2 -translate-y-1/2 z-50 hidden xl:flex flex-col gap-3 print:hidden" aria-label="Section navigation">
        @foreach ($cvSections as $cvSection)
            <a href="#{{ $cvSection['id'] }}"
               class="group flex items-center gap-2"
               title="{{ $cvSection['label'] }}">
                <span class="w-2.5 h-2.5 rounded-full bg-zinc-300 dark:bg-zinc-600 group-hover:bg-indigo-400 transition-colors duration-200"></span>
                <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">{{ $cvSection['label'] }}</span>
            </a>
        @endforeach
    </nav>
    @endif

    {{-- Main Content --}}
    <div class="mt-8 sm:mt-10 print:mt-5 space-y-8 print:space-y-6">

        {{-- Work Experience --}}
        @if (count($this->workExperience) > 0)
            <section class="break-inside-avoid cv-section" id="experience">
                <div class="flex items-center gap-3 mb-5 print:mb-4">
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                    <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400 print:text-zinc-800 print:tracking-[0.15em]">
                        <span class="inline-block mr-1 text-[10px] print:text-[9px]">◆</span>
                        Work Experience
                    </h2>
                    <div class="h-px flex-1 bg-gradient-to-l from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                </div>
                <div class="space-y-6 print:space-y-4">
                    @foreach ($this->workExperience as $index => $experience)
                        <div class="cv-item" style="animation-delay: {{ $index * 100 }}ms">
                            <x-about.work-experience :$experience />
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Projects --}}
        @if (count($this->projects) > 0)
            <section class="break-inside-avoid cv-section" id="projects">
                <div class="flex items-center gap-3 mb-5 print:mb-4">
                    <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                    <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400 print:text-zinc-800 print:tracking-[0.15em]">
                        <span class="inline-block mr-1 text-[10px] print:text-[9px]">◆</span>
                        Projects
                    </h2>
                    <div class="h-px flex-1 bg-gradient-to-l from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                </div>
                <div class="space-y-6 print:space-y-4">
                    @foreach ($this->projects as $index => $project)
                        <div class="cv-item" style="animation-delay: {{ $index * 100 }}ms">
                            <x-cv.project :$project />
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Skills & Education (two columns) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 print:gap-6">
            @if (count($this->skills) > 0)
                <section class="break-inside-avoid cv-section" id="skills">
                    <div class="flex items-center gap-3 mb-5 print:mb-4">
                        <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                        <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400 print:text-zinc-800 print:tracking-[0.15em]">
                            <span class="inline-block mr-1 text-[10px] print:text-[9px]">◆</span>
                            Skills
                        </h2>
                        <div class="h-px flex-1 bg-gradient-to-l from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                    </div>
                    <div class="space-y-4 print:space-y-3">
                        @foreach ($this->skills as $index => $skill)
                            <div class="cv-item" style="animation-delay: {{ $index * 100 }}ms">
                                <x-cv.skill :$skill />
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if (count($this->educations) > 0)
                <section class="break-inside-avoid cv-section" id="education">
                    <div class="flex items-center gap-3 mb-5 print:mb-4">
                        <div class="h-px flex-1 bg-gradient-to-r from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                        <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400 print:text-zinc-800 print:tracking-[0.15em]">
                            <span class="inline-block mr-1 text-[10px] print:text-[9px]">◆</span>
                            Education
                        </h2>
                        <div class="h-px flex-1 bg-gradient-to-l from-indigo-500/30 to-transparent print:from-zinc-400 print:to-transparent"></div>
                    </div>
                    <div class="space-y-4 print:space-y-3">
                        @foreach ($this->educations as $index => $education)
                            <div class="cv-item" style="animation-delay: {{ $index * 100 }}ms">
                                <x-cv.education :$education />
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</div>
