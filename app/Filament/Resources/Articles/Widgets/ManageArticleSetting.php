<?php

namespace App\Filament\Resources\Articles\Widgets;

use App\Settings\ArticleSetting;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\CanUseDatabaseTransactions;
use Filament\Pages\Concerns\HasUnsavedDataChangesAlert;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Exceptions\Halt;
use Filament\Widgets\Widget;

/**
 * @property-read Schema $form
 */
class ManageArticleSetting extends Widget implements HasSchemas
{
    use InteractsWithSchemas;
    use CanUseDatabaseTransactions;
    use HasUnsavedDataChangesAlert;

    protected string $view = 'filament.resources.articles.widgets.manage-article-setting';

    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->fillForm();
    }

    protected function fillForm(): void
    {
        $settings = app(ArticleSetting::class);

        $this->form->fill($settings->toArray());
    }

    public function save(): void
    {
        try {
            $this->beginDatabaseTransaction();

            $data = $this->form->getState();

            $settings = app(ArticleSetting::class);

            $settings->fill($data);

            $settings->save();

        } catch (Halt $e) {
            $e->shouldRollbackDatabaseTransaction()
                ? $this->rollBackDatabaseTransaction()
                : $this->commitDatabaseTransaction();

            return;
        } catch (\Throwable $e) {
            $this->rollBackDatabaseTransaction();

            throw $e;
        }

        $this->commitDatabaseTransaction();

        $this->rememberData();

        $this->getSavedNotification()?->send();
    }

    public function getSavedNotificationTitle(): ?string
    {
        return __('filament-spatie-laravel-settings-plugin::pages/settings-page.notifications.saved.title');
    }

    public function getSavedNotification(): ?Notification
    {
        $title = $this->getSavedNotificationTitle();

        if (blank($title)) {
            return null;
        }

        return Notification::make()
            ->success()
            ->title($title);
    }

    public function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-spatie-laravel-settings-plugin::pages/settings-page.form.actions.save.label'))
            ->submit($this->getSubmitFormLivewireMethodName())
            ->keyBindings(['mod+s']);
    }

    protected function getSubmitFormLivewireMethodName(): string
    {
        return 'save';
    }

    public function getSubmitFormAction(): Action
    {
        return $this->getSaveFormAction();
    }

    /**
     * @return array<Action | ActionGroup>
     */
    public function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->statePath('data')
            ->components([
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
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler($this->getSubmitFormLivewireMethodName())
            ->footer([
                $this->getFormActionsContentComponent(),
            ]);
    }

    public function getFormActionsContentComponent(): Component
    {
        return Actions::make($this->getFormActions())
            ->alignment(Alignment::Start)
            ->fullWidth(false)
            ->sticky(false)
            ->key('form-actions');
    }
}
