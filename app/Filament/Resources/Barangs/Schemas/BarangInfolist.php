<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BarangInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_barang'),
                TextEntry::make('nama_barang'),
                TextEntry::make('satuan')
                    ->badge(),
                TextEntry::make('stok')
                    ->numeric(),
                TextEntry::make('harga')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
