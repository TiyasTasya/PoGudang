<?php

namespace App\Filament\Resources\Barangs;

use App\Filament\Clusters\ManajemenBarangCluster;
use App\Filament\Resources\Barangs\Pages\CreateBarang;
use App\Filament\Resources\Barangs\Pages\EditBarang;
use App\Filament\Resources\Barangs\Pages\ListBarangs;
use App\Filament\Resources\Barangs\Pages\ViewBarang;
use App\Filament\Resources\Barangs\Schemas\BarangForm;
use App\Filament\Resources\Barangs\Schemas\BarangInfolist;
use App\Filament\Resources\Barangs\Tables\BarangsTable;
use App\Models\Barang;
use BackedEnum;
use Daljo25\FilamentTablerIcons\Enums\TablerIcon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $cluster = ManajemenBarangCluster::class;

    protected static string|BackedEnum|null $navigationIcon = TablerIcon::Table;

    protected static ?string $navigationLabel = 'Tabel Barang';

    protected static ?string $modelLabel = 'Tabel Barang';

    protected static ?string $pluralModelLabel = 'Data Barang';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return BarangForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BarangInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarangsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }


    public static function getPages(): array
    {
        return [
            'index'  => ListBarangs::route('/'),
            'create' => CreateBarang::route('/create'),
            'view'   => ViewBarang::route('/{record}'),
            'edit'   => EditBarang::route('/{record}/edit'),
        ];
    }
}
