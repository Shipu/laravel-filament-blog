<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Filament;
use Filament\Forms\HasForm;
use Filament\Pages\Page;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Illuminate\Support\Str;

class Settings extends Page
{
    use HasForm;

    public static $icon = 'heroicon-o-document-text';

    public static $view = 'filament.pages.settings';

    public static $saveButtonLabel = 'Update';

    public $record;

    public function submit()
    {
        Setting::set($this->record);

        $this->notify('Saved');
    }


    public function getForm(): Form
    {
        $form = app(Form::class);

        return $form->schema([
            Components\Tabs::make('Label')
                ->tabs([
                    Components\Tab::make(
                        'General',
                        [
                            Components\TextInput::make('name')->autofocus()->required(),
                        ],
                    ),
                ]),
        ]);

    }

    public function mount()
    {
        $this->record = Setting::getAll()->toArray();
    }

    protected function layoutData(): array
    {
        return [
           'form' => $this->getForm()
        ];
    }

    protected function viewData(): array
    {
        return [];
    }
}
