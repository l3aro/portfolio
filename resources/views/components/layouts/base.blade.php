<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <x-seo::meta />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if (str(app(\App\Settings\GeneralSetting::class)->googleAnalyticsKey)->isNotEmpty() && app()->isProduction())
            <x-layouts.google-analytics />
        @endif

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @fluxAppearance
        @filamentStyles
    </head>

    <body class="min-h-screen flex flex-col bg-white dark:bg-black max-w-7xl mx-auto">
        {{ $slot }}
        @livewire('notifications')
        @livewire('livewire-ui-spotlight')
        @fluxScripts
        @filamentScripts
    </body>
</html>
