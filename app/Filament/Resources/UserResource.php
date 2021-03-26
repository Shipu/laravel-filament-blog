<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PushNotificationResource\Pages;
use App\Filament\Resources\PushNotificationResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class UserResource extends \Filament\Resources\UserResource
{
    public static function form(Form $form): Form
    {
        $form = parent::form($form);

        $schema = $form->getSchema();

        $schema[0] = Components\TextInput::make('email')
            ->label('filament::resources/user-resource.form.email.label')
            ->email()
            ->disableAutocomplete()
            ->required()
            ->unique(static::getModel(), 'email', true);

        array_unshift($schema, Components\Grid::make([
            Components\TextInput::make('first_name')
                ->disableAutocomplete()
                ->required(),
            Components\TextInput::make('last_name')
                ->disableAutocomplete()
                ->required(),
        ]));

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        $table = parent::table($table);

        $columns = $table->getColumns();

        $columns[0] = Columns\Text::make('last_name')
            ->primary()
            ->searchable()
            ->sortable();

        array_unshift($columns, Columns\Text::make('first_name')
            ->primary()
            ->searchable()
            ->sortable());

        return $table->columns($columns);
    }

    public static function navigationItems()
    {
        return [];
    }
}
