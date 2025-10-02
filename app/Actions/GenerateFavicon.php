<?php

namespace App\Actions;

use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Storage;

class GenerateFavicon
{
    use AsAction;

    public function handle(string $path)
    {
        if (! class_exists(ImageManager::class)) {
            throw new \Exception('Intervention Image is not installed');
        }

        if (! file_exists($path)) {
            throw new \Exception('File does not exist');
        }

        // GD driver does not support ICO, so we use Imagick
        $manager = new ImageManager(new Driver());

        $manager
            ->read($path)
            ->resize(16, 16)
            ->save(Storage::disk('favicon')->path('favicon.ico'));

        $manager
            ->read($path)
            ->resize(32, 32)
            ->save(Storage::disk('favicon')->path('favicon.png'));
    }
}
