<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BarangInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Barang')
                    ->columns(2)
                    ->components([
                        TextEntry::make('kode_barang')
                            ->label('Kode Barang'),

                        TextEntry::make('nama_barang')
                            ->label('Nama Barang'),

                        TextEntry::make('satuan')
                            ->label('Satuan')
                            ->formatStateUsing(fn (string $state): string => strtoupper($state))
                            ->badge(),

                        TextEntry::make('stok')
                            ->label('Stok')
                            ->numeric(),

                        TextEntry::make('harga')
                            ->label('Harga')
                            ->money('IDR'),

                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d M Y, H:i'),

                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->dateTime('d M Y, H:i'),
                    ]),
            ]);
    }
}
