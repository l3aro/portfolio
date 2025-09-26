<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->native(false),
                        SpatieTagsInput::make('tags'),
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
