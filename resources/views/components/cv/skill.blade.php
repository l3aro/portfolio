@props([
    'skill',
])

@php
    /** @var \App\Data\AboutSkillData $skill */
@endphp

<section>
    <h3 class="text-sm font-bold text-zinc-800 dark:text-zinc-200 mb-2 print:text-sm print:mb-1.5">
        {{ str($skill->type)->snake()->replace('_', ' ')->title() }}
    </h3>
    <div class="flex flex-wrap gap-1.5 print:gap-1">
        @foreach ($skill->skill as $item)
            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-zinc-100 text-zinc-700 ring-1 ring-inset ring-zinc-200/80 dark:bg-zinc-800 dark:text-zinc-300 dark:ring-zinc-700/60 print:bg-zinc-100 print:text-zinc-700 print:ring-zinc-200">
                {{ $item }}
            </span>
        @endforeach
    </div>
</section>
