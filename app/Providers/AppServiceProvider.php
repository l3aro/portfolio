<?php

namespace App\Providers;

use App\Enums\MorphMapModelEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap(MorphMapModelEnum::map());

        Stringable::macro('toHtml', function () {
            /** @phpstan-ignore-next-line */
            return (new Stringable(Str::sanitizeHtml($this->value)))->toHtmlString();
        });

        URL::forceScheme(config('app.scheme'));
    }
}
