@props([
    'position',
])

@php
    /** @var \App\Data\AboutWorkExperienceData $position */
@endphp

<li class="flex gap-6">
    <dl class="flex flex-auto flex-wrap gap-x-4">
        <dt class="sr-only">Company</dt>
        <dd class="w-full flex-none text-sm font-medium text-zinc-900 dark:text-zinc-100">
            {{ $position->company }}
        </dd>
        <dt class="sr-only">Role</dt>
        <dd class="text-xs text-zinc-500 dark:text-zinc-400">
            {{ $position->role }}
        </dd>
        <dt class="sr-only">Date</dt>
        <dd class="ml-auto text-xs text-zinc-400 dark:text-zinc-500">
            <time datetime="{{ $position->duration }}">{{ $position->duration }}</time>
        </dd>
    </dl>
</li>
