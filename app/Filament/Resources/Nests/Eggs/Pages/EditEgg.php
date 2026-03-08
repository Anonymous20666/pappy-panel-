<?php

namespace App\Filament\Resources\Nests\Eggs\Pages;

use App\Filament\Resources\Nests\EggResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEgg extends EditRecord
{
    protected static string $resource = EggResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export')
                ->label('Export')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $record = $this->record;
                    $json = app(\App\Services\Eggs\Sharing\EggExporterService::class)->handle($record->id);
                    $filename = trim(preg_replace('/\W/', '-', kebab_case($record->name)), '-');
                    
                    return response()->streamDownload(function () use ($json) {
                        echo $json;
                    }, 'egg-' . $filename . '.json');
                }),
            Actions\DeleteAction::make()
                ->before(function ($record, $action) {
                    if ($record->servers()->count() > 0) {
                        \Filament\Notifications\Notification::make()
                            ->title('Cannot delete egg')
                            ->body('This egg has ' . $record->servers()->count() . ' server(s) associated. Please delete or reassign them first.')
                            ->danger()
                            ->send();
                        
                        $action->cancel();
                    }
                }),
        ];
    }
}
