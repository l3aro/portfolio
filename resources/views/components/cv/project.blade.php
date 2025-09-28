@props([
    'project',
])

@php
    /** @var \App\Data\AboutProjectData $project */
@endphp

<section class="md:border-l md:border-zinc-100 md:pl-6 md:dark:border-zinc-700/40">
    <div class="grid max-w-3xl grid-cols-1 gap-y-8 items-baseline md:grid-cols-4">
        <div class="flex flex-col gap-2">
            <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                {{ $project->name }}
            </h3>
            <p class="relative z-10 mb-3 flex items-center text-xs text-zinc-400 dark:text-zinc-500">
                {{ $project->duration }}
            </p>
        </div>
        <div class="md:col-span-3 space-y-4">
            <div class="space-y-4">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Customer</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">
                            {{ $project->customer !== '' ? $project->customer : '—' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Position</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">
                            {{ $project->position !== '' ? $project->position : '—' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Team Size</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">
                            {{ $project->teamSize !== '' ? $project->teamSize : '—' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Technologies</dt>
                        <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">
                            @php
                                $techList = is_array($project->technologies) ? implode(', ', $project->technologies) : (string) $project->technologies;
                            @endphp

                            {{ $techList !== '' ? $techList : '—' }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="mt-4">
                <h4 class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-2">Project Description</h4>
                <ul class="list-disc ml-4 space-y-2">
                    @foreach ($project->description as $description)
                        <li class="text-sm text-zinc-900 dark:text-zinc-100">
                            {{ $description }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
