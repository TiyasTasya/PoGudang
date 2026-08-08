<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ManajemenBarangCluster;
use App\Filament\Resources\Barangs\Actions\ExportBarangPdf;
use App\Filament\Resources\Barangs\Exports\BarangExporter;
use BackedEnum;
use Filament\Actions\ExportAction;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class ExportBarangPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowDownTray;

    protected static ?string $cluster = ManajemenBarangCluster::class;

    protected static ?string $navigationLabel = 'Ekspor Barang';

    // Judul utama halaman
    protected static ?string $title = 'Ekspor Data Barang';

    // Navigasi breadcrumb
    protected static ?string $breadcrumb = 'Ekspor Barang';

    protected static ?int $navigationSort = 3;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(BarangExporter::class)
                ->label('Ekspor Excel / CSV')
                ->modalHeading('Ekspor Data Barang ke Excel')
                ->modalDescription('Unduh data barang ke dalam format berkas spreadsheet.')
                ->modalSubmitActionLabel('Mulai Ekspor'),

            ExportBarangPdf::make(),
        ];
    }
}
