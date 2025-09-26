<footer
    class="bg-zinc-50 dark:bg-zinc-900 w-screen ring-1 ring-zinc-200 dark:ring-zinc-300/20 max-w-7xl"
    aria-labelledby="footer-heading"
>
    <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
        <div class="flex justify-center gap-x-6 md:order-2">
            <flux:button href="https://github.com/l3aro" icon="github" target="blank" variant="ghost" size="sm" />
            <flux:button
                href="https://www.linkedin.com/in/bao-duong-924717186/"
                icon="linkedin"
                target="blank"
                variant="ghost"
                size="sm"
            />
        </div>
        <p class="mt-8 text-center text-sm/6 text-zinc-600 md:order-1 md:mt-0 dark:text-zinc-400">
            &copy; {{ now()->year }} Your Company, Inc. All rights reserved.
        </p>
    </div>
</footer>
