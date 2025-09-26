<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Infolists\Components\SpatieTagsEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title'),
                        SpatieTagsEntry::make('tags'),
                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
                Section::make('Content')
                    ->columns(1)
                    ->collapsible()
                    ->collapsed(true)
                    ->schema([
                        TextEntry::make('content')
                            ->hiddenLabel()
                            ->placeholder('-')
                            ->html(),
                    ]),
                Section::make('Timestamps')
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(true)
                    ->schema([
                        TextEntry::make('published_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn(Article $record): bool => $record->trashed()),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
