@props([
    'position',
])

<li class="flex gap-4">
    <div
        class="relative mt-1 flex h-10 w-10 flex-none items-center justify-center rounded-full shadow-md ring-1 shadow-zinc-800/5 ring-zinc-900/5 dark:border dark:border-zinc-700/50 dark:bg-zinc-800 dark:ring-0"
    >
        <flux:icon name="building-office-2" class="size-6 text-zinc-400 dark:text-zinc-500" />
    </div>
    <dl class="flex flex-auto flex-wrap gap-x-2">
        <dt class="sr-only">Company</dt>
        <dd class="w-full flex-none text-sm font-medium text-zinc-900 dark:text-zinc-100">
            {{ $position['company'] }}
        </dd>
        <dt class="sr-only">Role</dt>
        <dd class="text-xs text-zinc-500 dark:text-zinc-400">
            {{ $position['title'] }}
        </dd>
        <dt class="sr-only">Date</dt>
        <dd class="ml-auto text-xs text-zinc-400 dark:text-zinc-500">
            <time datetime="{{ $position['start'] }}">{{ $position['start'] }}</time>
            <span aria-hidden="true">—</span>
            <time datetime="{{ $position['end'] }}">{{ $position['end'] }}</time>
        </dd>
    </dl>
</li>
