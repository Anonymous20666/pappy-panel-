<?php

namespace App\Filament\Resources\Nests\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Nests\NestResource;

class ListNests extends ListRecords
{
    protected static string $resource = NestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
            \Filament\Actions\Action::make('import')
                ->label('Import Egg')
                ->color('gray')
                ->form([
                    \Filament\Forms\Components\FileUpload::make('file')
                        ->label('Egg File (JSON)')
                        ->acceptedFileTypes(['application/json'])
                        ->required()
                        ->storeFiles(true),
                    \Filament\Forms\Components\Select::make('nest_id')
                        ->label('Associated Nest')
                        ->options(\App\Models\Nest::all()->pluck('name', 'id'))
                        ->required()
                        ->searchable(),
                ])
                ->action(function (array $data, $livewire) {
                    $tempFile = $data['file'];
                    
                    if (is_array($tempFile)) {
                        $tempFile = reset($tempFile);
                    }
                    
                    if (is_string($tempFile)) {
                        $possiblePaths = [
                            storage_path('app/livewire-tmp/' . $tempFile),
                            storage_path('app/private/' . $tempFile),
                            storage_path('app/' . $tempFile),
                        ];
                        
                        $foundPath = null;
                        foreach ($possiblePaths as $path) {
                            if (file_exists($path)) {
                                $foundPath = $path;
                                break;
                            }
                        }
                        
                        if (!$foundPath) {
                            \Filament\Notifications\Notification::make()
                                ->title('File not found')
                                ->body('Could not locate uploaded file. Tried: ' . implode(', ', array_map('basename', $possiblePaths)))
                                ->danger()
                                ->send();
                            return;
                        }
                        
                        $file = new \Illuminate\Http\UploadedFile(
                            $foundPath,
                            basename($foundPath),
                            'application/json',
                            null,
                            true
                        );
                    } elseif ($tempFile instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                        $realPath = $tempFile->getRealPath();
                        $file = new \Illuminate\Http\UploadedFile(
                            $realPath,
                            $tempFile->getClientOriginalName(),
                            $tempFile->getMimeType(),
                            null,
                            true
                        );
                    } else {
                        \Filament\Notifications\Notification::make()
                            ->title('Invalid file format')
                            ->body('Unexpected file format received.')
                            ->danger()
                            ->send();
                        return;
                    }

                    try {
                        app(\App\Services\Eggs\Sharing\EggImporterService::class)->handle($file, (int) $data['nest_id']);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Egg imported successfully')
                            ->success()
                            ->send();
                    } catch (\Exception $exception) {
                        \Filament\Notifications\Notification::make()
                            ->title('Failed to import egg')
                            ->body($exception->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
