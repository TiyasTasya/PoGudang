<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ManajemenBarangCluster;
use App\Filament\Resources\Barangs\Schemas\BarangForm;
use App\Models\Barang;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class CreateBarangPage extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPlusCircle;

    protected static ?string $cluster = ManajemenBarangCluster::class;

    protected static ?string $navigationLabel = 'Tambah Barang';

    protected static ?string $title = 'Tambah Barang Baru';

    protected static ?string $breadcrumb = 'Tambah Barang';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.create-barang-page';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return BarangForm::configure($schema)
            ->statePath('data')
            ->operation('create');
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                EmbeddedSchema::make('form'),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Barang')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        // Mendapatkan state data dari form
        $data = $this->form->getState();

        // Menyimpan ke dalam database
        Barang::create($data);

        // Menampilkan notifikasi sukses
        Notification::make()
            ->title('Barang Berhasil Ditambahkan')
            ->body('Data barang baru telah tersimpan ke dalam sistem.')
            ->success()
            ->send();

        // Mereset isi form (mengosongkan form) untuk input selanjutnya
        $this->form->fill();
    }
}
