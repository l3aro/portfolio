<?php

namespace App\Actions;

use App\Settings\About;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Browsershot\Browsershot;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class GenerateCvForDownload
{
    use AsAction;

    public function handle(): string
    {
        $filepath = $this->generateFilePath();

        $this->generatePdf($filepath);

        return $filepath;
    }

    protected function generateFilePath(): string
    {
        $temporaryDirectory = new TemporaryDirectory()
            ->create();

        $filename = str(app(About::class)->name)->slug();

        return $temporaryDirectory->path("{$filename}.pdf");
    }

    protected function generatePdf(string $filepath): void
    {
        $path = route('cv', [], false);
        $baseUrl = rtrim(config('app.browsershot_url', config('app.url')), '/');

        Browsershot::url("{$baseUrl}{$path}")
            ->noSandbox()
            ->format('A4')
            ->disableCaptureURLS()
            ->savePdf($filepath);
    }
}
