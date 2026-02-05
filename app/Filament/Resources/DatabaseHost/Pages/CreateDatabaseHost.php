<?php

namespace App\Filament\Resources\DatabaseHost\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\DatabaseHost\DatabaseHostResource;

class CreateDatabaseHost extends CreateRecord
{
    protected static string $resource = DatabaseHostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
