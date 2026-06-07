<?php

namespace App\Filament\Resources\PurchaseRequests\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PurchaseRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_pr')
                    ->label('Nomor PR')
                    ->searchable(),

                TextColumn::make('tanggal_pr')
                    ->label('Tanggal PR')
                    ->date()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Pembuat')
                    ->searchable(),

                TextColumn::make('project.nama_project') // ✅ Fix: id → nama_project
                    ->label('Project')
                    ->searchable(),

                TextColumn::make('barang.nama_barang') // ✅ Tambah kolom barang
                    ->label('Barang')
                    ->searchable(),

                TextColumn::make('qty_pesan') // ✅ Tambah qty
                    ->label('Qty')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('pajak_persen')
                    ->label('Pajak (%)')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('total_harga') // ✅ Tambah total harga
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match($state) { // ✅ Tambah warna badge
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                        default     => 'warning', // Pending
                    }),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
