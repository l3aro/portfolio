@props([
    'experience',
])

@php
    /** @var \App\Data\AboutWorkExperienceData $experience */
@endphp

<section class="relative pl-5 print:pl-4">
    {{-- Timeline line --}}
    <div class="absolute left-0 top-1.5 bottom-1 w-px bg-gradient-to-b from-indigo-500/50 via-indigo-400/30 to-transparent print:from-indigo-600/50 print:via-indigo-600/30"></div>

    {{-- Timeline dot --}}
    <div class="absolute -left-[4px] top-1.5 w-2 h-2 rounded-full bg-indigo-500 ring-3 ring-white dark:ring-zinc-900 print:ring-white print:bg-indigo-600"></div>

    <div class="grid grid-cols-1 gap-y-2 md:grid-cols-4 md:gap-x-5">
        {{-- Company & Duration --}}
        <div class="md:col-span-1">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-100 print:text-sm">
                {{ $experience->company }}
            </h3>
            <p class="mt-0.5 text-xs font-medium text-zinc-500 dark:text-zinc-500 print:text-[11px]">
                {{ $experience->duration }}
            </p>
        </div>

        {{-- Role & Responsibilities --}}
        <div class="md:col-span-3">
            <h4 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 print:text-indigo-700 print:text-sm">
                {{ $experience->role }}
            </h4>
            @if (count($experience->responsibilities) > 0)
                <ul class="mt-2 space-y-1 print:mt-1.5 print:space-y-0.5">
                    @foreach ($experience->responsibilities as $responsibility)
                        <li class="flex items-start gap-2 text-sm text-zinc-600 dark:text-zinc-400 print:text-xs print:text-zinc-600">
                            <span class="mt-1.5 w-1 h-1 flex-shrink-0 rounded-full bg-indigo-400 dark:bg-indigo-500 print:bg-indigo-500"></span>
                            <span class="leading-relaxed">{{ $responsibility }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
