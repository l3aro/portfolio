<?php

namespace App\Actions;

use App\Models\Contracts\HasUrl;
use App\Models\Url;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateUrl
{
    use AsAction;

    public function handle(HasUrl&Model $model): void
    {
        if ($model->url()->exists()) {
            return;
        }

        $handle = $model->getTitle();

        $this->createUrl($model, $handle);
    }

    protected function createUrl(HasUrl&Model $model, string $handle): void
    {
        $uniqueSlug = $this->getUniqueSlug(str($handle)->slug(separator: Url::SEPARATOR)->toString());

        $model->url()->create([
            'slug' => $uniqueSlug,
        ]);
    }

    protected function getUniqueSlug(string $slug, int $attempt = 1): string
    {
        $separator = Url::SEPARATOR;
        $newSlug = $attempt > 1 ? "{$slug}{$separator}{$attempt}" : $slug;

        if (Url::query()->where('slug', $newSlug)->exists()) {
            return $this->getUniqueSlug($slug, $attempt + 1);
        }

        return $newSlug;
    }
}
