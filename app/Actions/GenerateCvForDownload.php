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
        Browsershot::url('http://localhost:8080/cv')
            ->noSandbox()
            ->format('A4')
            ->disableCaptureURLS()
            ->authenticate(config('auth.cv.auth.username'), config('auth.cv.auth.password'))
            ->savePdf($filepath);
    }
}
