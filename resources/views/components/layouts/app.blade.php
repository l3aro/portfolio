<x-layouts.base>
    @livewire('notifications')
    @livewire('livewire-ui-spotlight')
    <div class="flex flex-col grow">
        <x-layouts.navigation />
        <flux:main container class="bg-zinc-50 dark:bg-zinc-900 ring-1 ring-zinc-200 dark:ring-zinc-300/20 pb-20!">
            {{ $slot }}
        </flux:main>
    </div>
    <x-layouts.footer />
</x-layouts.base>
