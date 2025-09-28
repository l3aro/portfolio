@props([
    'tool',
])

@php
    /** @var \App\Data\RecommendationTechnologyToolData $tool */
@endphp

<li class="group relative flex flex-col items-start">
    <h3 class="text-base font-semibold tracking-tight text-zinc-800 dark:text-zinc-100">
        {{ $tool->name }}
    </h3>
    <p class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">
        {{ $tool->description }}
    </p>
</li>
