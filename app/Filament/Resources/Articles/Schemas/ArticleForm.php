<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Url;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Basic Information')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                if ($get('url.slug')) {
                                    return;
                                }

                                if (str($state)->isEmpty()) {
                                    return;
                                }

                                $set('url.slug', str($state)->slug(Url::SEPARATOR)->toString());
                            })
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->native(false),
                        SpatieTagsInput::make('tags'),
                        Group::make()
                            ->relationship('url')
                            ->schema([
                                TextInput::make('slug')
                                    ->label('URL')
                                    ->unique(ignoreRecord: true)
                                    ->columnSpanFull(),
                            ]),
                        Textarea::make('description')
                            ->autosize()
                            ->columnSpanFull(),
                    ]),
                Section::make('Content')
                    ->columns(1)
                    ->collapsed()
                    ->collapsible()
                    ->schema([
                        RichEditor::make('content')
                            ->hiddenLabel()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
