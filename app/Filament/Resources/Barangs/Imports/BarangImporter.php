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
                ->label('Kode Barang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('nama_barang')
                ->label('Nama Barang')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('satuan')
                ->label('Satuan')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('stok')
                ->label('Stok')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('harga')
                ->label('Harga Satuan')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    /**
     * Menambahkan templat baris contoh agar user tinggal mengisi data.
     */
    public static function csvXlsxHeaderExample(): array
    {
        return [
            'kode_barang' => 'BRG-001',
            'nama_barang' => 'Kertas A4 80gsm',
            'satuan'      => 'box',
            'stok'        => 50,
            'harga'       => 45000,
        ];
    }

    public function resolveRecord(): Barang
    {
        return new Barang();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Proses impor data barang telah selesai. ' . Number::format($import->successful_rows) . ' baris berhasil diimpor.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' baris gagal diimpor.';
        }

        return $body;
    }
}
