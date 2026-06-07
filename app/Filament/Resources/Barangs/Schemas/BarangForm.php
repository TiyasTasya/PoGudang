<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('nama_barang')
                    ->label('Nama Barang')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                        if ($operation !== 'create' || empty($state)) {
                            return;
                        }

                        $set('kode_barang', static::generateKodeBarang($state));
                    }),

                TextInput::make('kode_barang')
                    ->label('Kode Barang')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled()
                    ->dehydrated(),

                Select::make('satuan')
                    ->label('Satuan')
                    ->options(['pcs' => 'Pcs', 'box' => 'Box', 'set' => 'Set'])
                    ->required(),

                TextInput::make('stok')
                    ->label('Stok')
                    ->required()
                    ->numeric()
                    ->default(0),

                TextInput::make('harga')
                    ->label('Harga Satuan')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),
            ]);
    }

    protected static function generateKodeBarang(string $nama): string
    {
        $clean = strtoupper(preg_replace('/[^A-Za-z0-9 ]/', '', $nama));
        $kata  = array_filter(explode(' ', $clean));

        if (count($kata) >= 2) {
            $prefix = implode('', array_map(
                fn($k) => substr($k, 0, 1),
                array_slice($kata, 0, 3)
            ));
            $prefix = str_pad($prefix, 3, substr($kata[0], 1, 1) ?: 'X');
        } else {
            $consonants = preg_replace('/[AEIOU]/', '', $clean);
            $prefix = strlen($consonants) >= 3
                ? substr($consonants, 0, 3)
                : substr(str_replace(' ', '', $clean), 0, 3);
            $prefix = str_pad($prefix, 3, 'X');
        }

        $lastBarang = \App\Models\Barang::where('kode_barang', 'LIKE', $prefix . '-%')
            ->latest('id')
            ->first();

        $noUrut = $lastBarang ? (int) substr($lastBarang->kode_barang, -3) + 1 : 1;

        return $prefix . '-' . str_pad($noUrut, 3, '0', STR_PAD_LEFT);
    }
}
