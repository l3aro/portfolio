<?php

namespace App\Filament\Pages;

use App\Settings\About;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use JsonMachine\Items;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use stdClass;

class ManageAbout extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static string $settings = About::class;

    public static function getNavigationLabel(): string
    {
        return 'About';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import')
                ->label('Import')
                ->icon(Heroicon::OutlinedArrowTrendingUp)
                ->schema([
                    FileUpload::make('file')
                        ->acceptedFileTypes(['application/json'])
                        ->rules(['required', 'file', 'extensions:json'])
                        ->storeFiles(false)
                        ->required(),
                ])
                ->action(function (Action $action, array $data) {
                    /** @var TemporaryUploadedFile $jsonFile */
                    $jsonFile = $data['file'];

                    $items = Items::fromStream($jsonFile->readStream());
                    $setting = app(About::class);
                    foreach ($items as $key => $item) {
                        $setting->$key = $item instanceof stdClass
                            ? (array) $item
                            : $item;
                    }
                    $setting->save();

                    $action->success();
                }),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->schema([
                        ToggleButtons::make('enabled')
                            ->boolean()
                            ->inline()
                            ->required(),
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('title')
                            ->required(),
                        KeyValue::make('personalInfo')
                            ->reorderable(),
                        Textarea::make('careerObjective')
                            ->autosize(),
                        Repeater::make('workExperience')
                            ->schema([
                                TextInput::make('company')
                                    ->required(),
                                TextInput::make('role')
                                    ->required(),
                                TextInput::make('duration')
                                    ->required(),
                                Repeater::make('responsibilities')
                                    ->required()
                                    ->simple(
                                        TextInput::make('responsibility')
                                            ->required(),
                                    ),
                            ]),
                        Repeater::make('projects')
                            ->schema([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('duration')
                                    ->required(),
                                TextInput::make('customer')
                                    ->required(),
                                Repeater::make('description')
                                    ->required()
                                    ->simple(
                                        Textarea::make('description')
                                            ->autosize()
                                            ->required(),
                                    ),
                                TextInput::make('teamSize')
                                    ->numeric()
                                    ->minValue(1)
                                    ->required(),
                                TextInput::make('position')
                                    ->required(),
                                Repeater::make('technologies')
                                    ->required()
                                    ->simple(
                                        TextInput::make('technology')
                                            ->required(),
                                    ),
                            ]),
                        Repeater::make('skills')
                            ->schema([
                                TextInput::make('type')
                                    ->required(),
                                Repeater::make('skill')
                                    ->required()
                                    ->simple(
                                        TextInput::make('name')
                                            ->required(),
                                    ),
                            ]),
                        Repeater::make('educations')
                            ->schema([
                                TextInput::make('institution')
                                    ->required(),
                                TextInput::make('major')
                                    ->required(),
                                TextInput::make('duration')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }
}
