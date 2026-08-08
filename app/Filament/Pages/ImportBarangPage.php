<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ManajemenBarangCluster;
use App\Filament\Resources\Barangs\Imports\BarangImporter;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Actions\ImportAction;
use Filament\Pages\Page;


class ImportBarangPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = TablerIcon::FileUpload;

    protected static ?string $cluster = ManajemenBarangCluster::class;

    protected static ?string $navigationLabel = 'Impor Barang';

    // Judul utama halaman
    protected static ?string $title = 'Impor Data Barang';

    // Navigasi breadcrumb
    protected static ?string $breadcrumb = 'Impor Barang';

    protected static ?int $navigationSort = 4;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->importer(BarangImporter::class)
                ->label('Impor Excel / CSV')
                ->modalHeading('Impor Data Barang')
                ->modalDescription('Unggah berkas Excel atau CSV untuk memasukkan data barang secara sekaligus.')
                ->modalSubmitActionLabel('Mulai Impor'),
        ];
    }
}
