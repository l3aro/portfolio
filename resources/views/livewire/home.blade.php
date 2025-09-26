<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="mt-9 w-full">
    <div class="mx-auto max-w-2xl">
        <img src="{{ asset('images/avatar.jpg') }}" alt="Avatar" class="w-32 h-32 rounded-full mb-6 mx-auto" />
        <h1 class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl dark:text-zinc-100">
            Software designer, founder, and amateur astronaut.
        </h1>
        <div class="mt-6 text-base text-zinc-600 dark:text-zinc-400">
            I'm Spencer, a software designer and entrepreneur based in New York
            City. I'm the founder and CEO of Planetaria, where we develop
            technologies that empower regular people to explore space on their
            own terms.
        </div>
        <div class="mt-6 flex gap-6">
            <flux:button href="https://github.com/l3aro" icon="github" target="blank"></flux:button>
            <flux:button href="https://www.linkedin.com/in/bao-duong-924717186/" icon="linkedin" target="blank">
            </flux:button>
        </div>
    </div>
</div>
