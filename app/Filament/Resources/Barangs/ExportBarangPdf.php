<?php

namespace App\Filament\Resources\Barangs\Actions;

use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;

class ExportBarangPdf
{
    public static function make(): Action
    {
        return Action::make('exportPdf')
            ->label('Ekspor PDF')
            ->icon('heroicon-o-document-arrow-down')
            ->action(function () {
                $barangs = Barang::orderBy('nama_barang')->get();

                $pdf = Pdf::loadView('pdf.barangs', [
                    'barangs' => $barangs,
                ])->setPaper('a4', 'portrait');

                return response()->streamDownload(
                    fn () => print($pdf->output()),
                    'data-barang-' . now()->format('Ymd_His') . '.pdf'
                );
            });
    }
}
