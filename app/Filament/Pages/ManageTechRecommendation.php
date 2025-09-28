<?php

namespace App\Filament\Pages;

use App\Settings\TechRecommendation;
use BackedEnum;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageTechRecommendation extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static string $settings = TechRecommendation::class;

    public static function getNavigationLabel(): string
    {
        return 'Tech Recommendation';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Basic Information')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        ToggleButtons::make('enabled')
                            ->boolean()
                            ->inline()
                            ->required(),
                        Textarea::make('description')
                            ->autosize()
                            ->columnSpanFull()
                            ->required(),
                    ]),
                Section::make('Technologies')
                    ->collapsible()
                    ->columns(1)
                    ->schema([
                        Repeater::make('technologies')
                            ->hiddenLabel()
                            ->columnSpanFull()
                            ->schema([
                                TextInput::make('category')
                                    ->required(),
                                Repeater::make('tools')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('description')
                                            ->required(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
