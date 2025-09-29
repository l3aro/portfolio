<?php

namespace App\Filament\Pages;

use App\Actions\GenerateFavicon;
use App\Settings\GeneralSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Concurrency;
use Illuminate\Support\Facades\Storage;

class ManageGeneralSetting extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::GlobeAsiaAustralia;

    protected static string $settings = GeneralSetting::class;

    public static function getNavigationLabel(): string
    {
        return 'General Settings';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('siteName')
                    ->required()
                    ->maxLength(255),
                TextInput::make('siteDescription')
                    ->required()
                    ->maxLength(255),
                TagsInput::make('siteKeywords'),
                TextInput::make('googleAnalyticsKey')
                    ->placeholder('G-XXXXXXXXXX')
                    ->hint('Measurement ID')
                    ->maxLength(12),
                FileUpload::make('siteLogo')
                    ->translateLabel()
                    ->disk(GeneralSetting::disk())
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('1:1'),
                FileUpload::make('siteImage')
                    ->translateLabel()
                    ->disk(GeneralSetting::disk())
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('2:1')
                    ->imageResizeTargetWidth('1200')
                    ->imageResizeTargetHeight('600'),
            ]);
    }

    protected function afterSave(): void
    {
        /** @var GeneralSetting $setting */
        $setting = app(GeneralSetting::class);

        $path = Storage::disk(GeneralSetting::disk())->path($setting->siteLogo);

        Concurrency::defer(fn() => GenerateFavicon::make()->handle($path));
    }
}
