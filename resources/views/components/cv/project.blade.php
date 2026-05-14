@props([
    'project',
])

@php
    /** @var \App\Data\AboutProjectData $project */
@endphp

<section class="relative pl-5 print:pl-4">
    {{-- Timeline line --}}
    <div class="absolute left-0 top-1.5 bottom-1 w-px bg-gradient-to-b from-indigo-500/50 via-indigo-400/30 to-transparent print:from-indigo-600/50 print:via-indigo-600/30"></div>

    {{-- Timeline dot --}}
    <div class="absolute -left-[4px] top-1.5 w-2 h-2 rounded-full bg-indigo-500 ring-3 ring-white dark:ring-zinc-900 print:ring-white print:bg-indigo-600"></div>

    <div class="grid grid-cols-1 gap-y-2 md:grid-cols-4 md:gap-x-5">
        {{-- Project Name & Duration --}}
        <div class="md:col-span-1">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-100 print:text-sm">
                {{ $project->name }}
            </h3>
            <p class="mt-0.5 text-xs font-medium text-zinc-500 dark:text-zinc-500 print:text-[11px]">
                {{ $project->duration }}
            </p>
        </div>

        {{-- Details --}}
        <div class="md:col-span-3 space-y-3 print:space-y-2">
            {{-- Metadata Grid --}}
            <dl class="grid grid-cols-2 sm:grid-cols-3 gap-2 print:gap-1.5">
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 print:text-zinc-500">Customer</dt>
                    <dd class="mt-0.5 text-sm text-zinc-700 dark:text-zinc-300 print:text-xs print:text-zinc-600">
                        {{ $project->customer !== '' ? $project->customer : '—' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 print:text-zinc-500">Position</dt>
                    <dd class="mt-0.5 text-sm text-zinc-700 dark:text-zinc-300 print:text-xs print:text-zinc-600">
                        {{ $project->position !== '' ? $project->position : '—' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 print:text-zinc-500">Team Size</dt>
                    <dd class="mt-0.5 text-sm text-zinc-700 dark:text-zinc-300 print:text-xs print:text-zinc-600">
                        {{ $project->teamSize !== '' ? $project->teamSize : '—' }}
                    </dd>
                </div>
            </dl>

            {{-- Technologies as Pills --}}
            @php
                $technologies = is_array($project->technologies) ? $project->technologies : array_filter(array_map('trim', explode(',', (string) $project->technologies)));
            @endphp
            @if (count($technologies) > 0)
                <div>
                    <dt class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500 mb-1.5 print:text-zinc-500 print:mb-1">Technologies</dt>
                    <div class="flex flex-wrap gap-1 print:gap-1">
                        @foreach ($technologies as $tech)
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[11px] font-medium bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-600/20 dark:bg-indigo-400/10 dark:text-indigo-300 dark:ring-indigo-400/30 print:bg-indigo-50 print:text-indigo-700 print:ring-indigo-600/20">
                                {{ trim($tech) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Description --}}
            @if (count($project->description) > 0)
                <div class="mt-2 print:mt-1.5">
                    <ul class="space-y-1 print:space-y-0.5">
                        @foreach ($project->description as $description)
                            <li class="flex items-start gap-2 text-sm text-zinc-600 dark:text-zinc-400 print:text-xs print:text-zinc-600">
                                <span class="mt-1.5 w-1 h-1 flex-shrink-0 rounded-full bg-indigo-400 dark:bg-indigo-500 print:bg-indigo-500"></span>
                                <span class="leading-relaxed">{{ $description }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
