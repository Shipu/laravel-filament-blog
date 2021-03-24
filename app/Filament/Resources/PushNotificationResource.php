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

class PushNotificationResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('title')->autofocus()->required(),
                Components\Textarea::make('body')->autofocus()->required(),
                Components\TextInput::make('notification_type')->autofocus()->required(),
                Components\TextInput::make('redirect_url')->autofocus()->required(),
                Components\Image::make('redirect_url')->autofocus()->required(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListPushNotifications::routeTo('/', 'index'),
            Pages\CreatePushNotification::routeTo('/create', 'create'),
            Pages\EditPushNotification::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
