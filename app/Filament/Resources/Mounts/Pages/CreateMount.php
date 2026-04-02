<?php

namespace App\Filament\Resources\Mounts\Pages;

use App\Filament\Resources\Mounts\MountResource;
use App\Services\Activity\ActivityLogService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateMount extends CreateRecord
{
    protected static string $resource = MountResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data[0]) && is_array($data[0])) {
            $data = $data[0];
        }

        $data['uuid'] = Str::uuid()->toString();

        return $data;
    }

    protected function afterCreate(): void
    {
        app(ActivityLogService::class)
            ->subject($this->record)
            ->event('mount:create')
            ->log();
    }
}
