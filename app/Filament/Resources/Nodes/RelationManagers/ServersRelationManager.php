<?php

namespace App\Filament\Resources\Nodes\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Allocation;
use App\Services\Allocations\AssignmentService;
use App\Services\Allocations\AllocationDeletionService;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Log;

class ServersRelationManager extends RelationManager
{
    protected static string $relationship = 'servers';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(trans('admin/servers.table.name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('user')
                    ->label(trans('admin/servers.table.owner'))
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        Log::debug('Formatting owner email for server relation manager', ['state' => $state]);
                        return $state ? $state->name_first . ' ' . $state->name_last : trans('admin/servers.table.no_owner');
                    })
                    ->icon('heroicon-o-user') // TODO: Consider putting the user's Gravatar here
                    ->sortable(),
                TextColumn::make('allocation')
                    ->label(trans('admin/servers.table.allocation'))
                    ->formatStateUsing(fn ($state) => $state?->toString()), // I don't image any server would be without an allocation, unless somebody manually tampered with the database
                TextColumn::make('status')
                    ->label(trans('admin/servers.table.status'))
                    ->placeholder(trans('admin/servers.table.no_status'))
                    ->badge()
                    ->sortable(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(trans('admin/servers.actions.delete'))
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $records->each(function ($record) {
                                app(AllocationDeletionService::class)->delete($record->allocation);
                                $record->delete();
                            });
                        }),
                ]),
            ]);
    }
}