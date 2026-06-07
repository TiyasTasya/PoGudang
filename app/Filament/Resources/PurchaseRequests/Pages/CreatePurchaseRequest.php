<?php

namespace App\Filament\Resources\PurchaseRequests\Pages;

use App\Filament\Resources\PurchaseRequests\PurchaseRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchaseRequest extends CreateRecord
{
    protected static string $resource = PurchaseRequestResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Purchase Request berhasil dibuat';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
