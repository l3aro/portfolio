@props([
    'education',
])
@php
    /** @var \App\Data\AboutEducationData $education */
@endphp

<section class="relative pl-5 print:pl-4">
    {{-- Timeline line with smoother gradient --}}
    <div class="absolute left-0 top-1.5 bottom-1 w-px bg-gradient-to-b from-indigo-500/60 via-indigo-400/35 to-transparent print:from-zinc-400 print:via-zinc-400/50 print:to-transparent"></div>

    {{-- Timeline dot with ring on screen --}}
    <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 rounded-full bg-indigo-500 ring-4 ring-white dark:ring-zinc-900 print:ring-white print:bg-indigo-600 print:w-2 print:h-2 print:ring-2 print:-left-[3.5px]">
        <div class="absolute inset-0 rounded-full bg-indigo-400/30 animate-ping print:hidden"></div>
    </div>

    <div>
        <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-100 print:text-sm">
            {{ $education->institution }}
        </h3>
        <p class="mt-0.5 text-xs font-medium text-zinc-500 dark:text-zinc-500 print:text-[11px]">
            {{ $education->duration }}
        </p>
        <p class="mt-1.5 text-sm font-semibold text-indigo-600 dark:text-indigo-400 print:text-xs print:text-indigo-700">
            {{ $education->major }}
        </p>
    </div>
</section>
