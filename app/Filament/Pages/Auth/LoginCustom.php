<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use SensitiveParameter;

class LoginCustom extends Login
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label(__('Nama / Email'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->validationAttribute(__('Nama / Email'))
            ->rule(function () {
                return function (string $attribute, $value, \Closure $fail) {
                    $field = $this->resolveLoginField($value);

                    $exists = \App\Models\User::query()
                        ->where($field, $value)
                        ->exists();

                    if (! $exists) {
                        $fail(__('filament-panels::auth/pages/login.messages.failed'));
                    }
                };
            });
    }

    /**
     * Menentukan apakah input login berupa email atau nama/username.
     */
    protected function resolveLoginField(string $login): string
    {
        return filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        $login = trim($data['login']);
        $field = $this->resolveLoginField($login);

        return [
            $field => $login,
            'password' => $data['password'],
        ];
    }
}
