<x-filament-panels::page>
    {{ $this->content }}

    <div class="mt-6">
        <x-filament::button wire:click="save" wire:loading.attr="disabled">
            Simpan Barang
        </x-filament::button>
    </div>
</x-filament-panels::page>
