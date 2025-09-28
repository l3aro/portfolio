@props([
    'education',
])
@php
    /** @var \App\Data\AboutEducationData $education */
@endphp

<section class="md:border-l md:border-zinc-100 md:pl-6 md:dark:border-zinc-700/40">
    <div class="grid grid-cols-1 gap-y-8 items-baseline">
        <div class="flex flex-col gap-2">
            <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                {{ $education->institution }}
            </h3>
            <p class="relative z-10 mb-3 flex items-center text-xs text-zinc-400 dark:text-zinc-500">
                {{ $education->duration }}
            </p>
        </div>
        <div class="md:col-span-3">
            <div class="group relative flex flex-col items-start">
                <h4 class="text-base tracking-tight text-zinc-800 dark:text-zinc-100">
                    Major: {{ $education->major }}
                </h4>
            </div>
        </div>
    </div>
</section>
