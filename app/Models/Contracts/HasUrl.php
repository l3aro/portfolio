<?php

namespace App\Models\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface HasUrl
{
    public function getTitle(): string;

    public function url(): MorphOne;

    public function getBreadcrumbs(): array;
}
