<?php

namespace App\Filament\Resources\Nests\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EggsRelationManager extends RelationManager
{
    protected static string $relationship = 'eggs';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
            ])
            ->headerActions([
                \Filament\Actions\Action::make('create')
                    ->label('Create Egg')
                    ->icon('heroicon-o-plus')
                    ->url(fn () => \App\Filament\Resources\Nests\EggResource::getUrl('create', ['nest_id' => $this->getOwnerRecord()->id])),
            ])
            ->actions([
                \Filament\Actions\Action::make('view')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn ($record) => \App\Filament\Resources\Nests\EggResource::getUrl('edit', ['record' => $record])),
                \Filament\Actions\Action::make('export')
                    ->label('Export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($record) {
                        $json = app(\App\Services\Eggs\Sharing\EggExporterService::class)->handle($record->id);
                        $filename = trim(preg_replace('/\W/', '-', kebab_case($record->name)), '-');
                        
                        return response()->streamDownload(function () use ($json) {
                            echo $json;
                        }, 'egg-' . $filename . '.json');
                    }),
                \Filament\Actions\DeleteAction::make()
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
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make()
                    ->before(function ($records) {
                        $protectedCount = $records->filter(fn ($record) => $record->servers()->count() > 0)->count();
                        if ($protectedCount > 0) {
                            \Filament\Notifications\Notification::make()
                                ->title('Cannot delete eggs with servers')
                                ->body("{$protectedCount} egg(s) have associated servers and were skipped.")
                                ->warning()
                                ->send();
                        }
                    })
                    ->action(function ($records) {
                        $deletable = $records->filter(fn ($record) => $record->servers()->count() === 0);
                        $deletable->each->delete();
                    }),
            ]);
    }
}
