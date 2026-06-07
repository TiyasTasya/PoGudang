<?php

namespace App\Filament\Resources\PurchaseRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PurchaseRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('no_pr')
                    ->label('Nomor PR'),

                TextEntry::make('tanggal_pr')
                    ->label('Tanggal PR')
                    ->date(),

                TextEntry::make('user.name')
                    ->label('Pembuat (User)'),

                TextEntry::make('project.nama_project') // ✅ Fix: id → nama_project
                    ->label('Project'),

                TextEntry::make('barang.nama_barang') // ✅ Tambah field barang
                    ->label('Barang'),

                TextEntry::make('qty_pesan') // ✅ Tambah qty
                    ->label('Jumlah (Qty)')
                    ->numeric(),

                TextEntry::make('pajak_persen')
                    ->label('Pajak (%)')
                    ->numeric(),

                TextEntry::make('total_harga') // ✅ Tambah total harga
                    ->label('Total Harga')
                    ->numeric()
                    ->money('IDR'),

                TextEntry::make('status')
                    ->label('Status')
                    ->badge(),

                TextEntry::make('keterangan')
                    ->label('Keterangan')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
