<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <x-seo::meta />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @fluxAppearance
    </head>

    <body class="min-h-screen flex flex-col bg-white dark:bg-black max-w-7xl mx-auto">
        <div class="flex flex-col grow">
            <x-layouts.navigation />
            <flux:main container class="bg-zinc-50 dark:bg-zinc-900 ring-1 ring-zinc-200 dark:ring-zinc-300/20">
                {{ $slot }}
            </flux:main>
        </div>
        <x-layouts.footer />
        @fluxScripts
    </body>
</html>
