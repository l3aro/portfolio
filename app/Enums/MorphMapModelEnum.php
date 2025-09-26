<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum MorphMapModelEnum: string
{
    case Article = \App\Models\Article::class;
    case User = \App\Models\User::class;

    public static function map(): array
    {
        return Arr::mapWithKeys(self::cases(), fn($value) => [$value->name => $value->value]);
    }
}
