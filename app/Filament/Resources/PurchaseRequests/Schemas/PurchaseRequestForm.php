<?php

namespace App\Filament\Resources\PurchaseRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Section;

class PurchaseRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Purchase Request')
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->schema([
                        TextInput::make('no_pr')
                            ->label('Nomor PR')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->default(fn() => static::generateNomorPR())
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),

                        DatePicker::make('tanggal_pr')
                            ->label('Tanggal PR')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->columnSpan(1),

                        Select::make('user_id')
                            ->label('Pembuat (User)')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),

                        Select::make('project_id')
                            ->label('Project')
                            ->relationship('project', 'nama_project')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),
                    ]),

                Section::make('Detail Barang & Harga')
                    ->icon('heroicon-o-shopping-cart')
                    ->columns(2)
                    ->schema([
                        Select::make('barang_id')
                            ->label('Pilih Barang')
                            ->relationship('barang', 'nama_barang')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->afterStateUpdated(fn(Set $set, Get $get) => static::hitungTotalHarga($set, $get))
                            ->live()
                            ->columnSpan(2),

                        TextInput::make('qty_pesan')
                            ->label('Jumlah (Qty)')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1)
                            ->suffix('unit')
                            ->afterStateUpdated(fn(Set $set, Get $get) => static::hitungTotalHarga($set, $get))
                            ->live()
                            ->columnSpan(1),

                        TextInput::make('pajak_persen')
                            ->label('Pajak')
                            ->numeric()
                            ->required()
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%')
                            ->afterStateUpdated(fn(Set $set, Get $get) => static::hitungTotalHarga($set, $get))
                            ->live()
                            ->columnSpan(1),

                        Placeholder::make('total_harga_display')
                            ->label('Total Harga')
                            ->content(function (Get $get): string {
                                $total = (float) ($get('total_harga') ?? 0);
                                return 'Rp ' . number_format($total, 0, ',', '.');
                            })
                            ->columnSpan(2),

                        TextInput::make('total_harga')
                            ->numeric()
                            ->required()
                            ->default(0)
                            ->hidden()
                            ->dehydrated(),
                    ]),

                Section::make('Status & Keterangan')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'Pending'  => 'Pending',
                                'Approved' => 'Approved',
                                'Rejected' => 'Rejected',
                            ])
                            ->default('Pending')
                            ->required()
                            ->native(false)
                            ->columnSpan(1),

                        Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->placeholder('Tambahkan catatan jika diperlukan...')
                            ->rows(3)
                            ->default(null)
                            ->columnSpan(2),
                    ]),

            ]);
    }

    protected static function generateNomorPR(): string
    {
        $tahun = date('Y');
        $bulan = date('m');

        $lastPr = \App\Models\PurchaseRequest::whereYear('tanggal_pr', $tahun)
            ->whereMonth('tanggal_pr', $bulan)
            ->latest('tanggal_pr')
            ->first();

        $noUrut = $lastPr ? (int) substr($lastPr->no_pr, -4) + 1 : 1;

        return 'PR-' . $tahun . $bulan . '-' . str_pad($noUrut, 4, '0', STR_PAD_LEFT);
    }

    protected static function hitungTotalHarga(Set $set, Get $get): void
    {
        $barangId   = $get('barang_id');
        $qty        = (float) ($get('qty_pesan') ?? 0);
        $pajakPersen = (float) ($get('pajak_persen') ?? 0);

        if (!$barangId || $qty <= 0) {
            $set('total_harga', 0);
            return;
        }

        $barang = \App\Models\Barang::find($barangId);

        if ($barang) {
            $subTotal    = $barang->harga * $qty;
            $nominalPajak = $subTotal * ($pajakPersen / 100);
            $set('total_harga', $subTotal + $nominalPajak);
        }
    }
}
