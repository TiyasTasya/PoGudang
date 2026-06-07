<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Project;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('kode_project')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->default(function () {
                        $tahun = date('Y');
                        $lastProject = Project::whereYear('created_at', $tahun)
                            ->latest()
                            ->first();
                        if (!$lastProject) {
                            $noUrut = 1;
                        } else {
                            $noUrut = (int) substr($lastProject->kode_project, -4) + 1;
                        }
                        return 'PRJ-' . $tahun . '-' . str_pad($noUrut, 4, '0', STR_PAD_LEFT);
                    })
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('nama_project')
                    ->required(),

                Textarea::make('alamat')
                    ->columnSpan('full')
                    ->required(),
            ]);
    }
}
