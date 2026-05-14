@props([
    'education',
])
@php
    /** @var \App\Data\AboutEducationData $education */
@endphp

<section class="relative pl-5 print:pl-4">
    {{-- Timeline line --}}
    <div class="absolute left-0 top-1.5 bottom-1 w-px bg-gradient-to-b from-indigo-500/50 via-indigo-400/30 to-transparent print:from-indigo-600/50 print:via-indigo-600/30"></div>

    {{-- Timeline dot --}}
    <div class="absolute -left-[4px] top-1.5 w-2 h-2 rounded-full bg-indigo-500 ring-3 ring-white dark:ring-zinc-900 print:ring-white print:bg-indigo-600"></div>

    <div>
        <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-100 print:text-sm">
            {{ $education->institution }}
        </h3>
        <p class="mt-0.5 text-xs font-medium text-zinc-500 dark:text-zinc-500 print:text-[11px]">
            {{ $education->duration }}
        </p>
        <p class="mt-1 text-sm font-medium text-indigo-600 dark:text-indigo-400 print:text-xs print:text-indigo-700">
            {{ $education->major }}
        </p>
    </div>
</section>
