<?php

namespace App\Filament\Pages;

use App\Settings\Landing;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageLandingSetting extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static string $settings = Landing::class;

    public static function getNavigationLabel(): string
    {
        return 'Landing';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                FileUpload::make('avatar')
                    ->translateLabel()
                    ->disk(Landing::disk())
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('1:1'),
            ]);
    }
}
