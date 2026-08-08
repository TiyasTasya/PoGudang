<?php

namespace App\Filament\Resources\Barangs\Imports;

use App\Models\Barang;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class BarangImporter extends Importer
{
    protected static ?string $model = Barang::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('kode_barang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('nama_barang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('satuan')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('stok')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('harga')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): Barang
    {
        return new Barang();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your barang import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
