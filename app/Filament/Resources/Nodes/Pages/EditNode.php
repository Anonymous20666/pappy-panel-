<?php

namespace App\Filament\Resources\Nodes\Pages;

use App\Filament\Resources\Nodes\NodeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNode extends EditRecord
{
    protected static string $resource = NodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->before(function () {
                    if ($this->record->servers()->count() > 0) {
                        throw new \Exception(trans('admin/nodes.messages.cannot_delete_with_servers'));
                    }
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
