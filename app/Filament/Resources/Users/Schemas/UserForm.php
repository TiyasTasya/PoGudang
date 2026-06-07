<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrated(fn(?string $state): bool => filled($state))
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->required(fn(string $operation): bool => $operation === 'create')
            ]);
    }
}
