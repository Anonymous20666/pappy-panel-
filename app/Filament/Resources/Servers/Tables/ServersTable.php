<?php

namespace App\Filament\Resources\Servers\Tables;

use App\Models\Server;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(trans('admin/servers.table.id'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label(trans('admin/servers.table.name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('user.email')
                    ->label(trans('admin/servers.table.owner'))
                    ->searchable()
                    ->formatStateUsing(fn (Server $record) => $record->user->name_first . ' ' . $record->user->name_last)
                    ->icon('heroicon-o-user') // TODO: Consider putting the user's Gravatar here
                    ->sortable(),

                TextColumn::make('node.name')
                    ->label(trans('admin/servers.table.node'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('allocation')
                    ->label(trans('admin/servers.table.allocation'))
                    ->formatStateUsing(fn (Server $record) => $record->allocation?->toString())
                    ->toggleable(),

                TextColumn::make('status')
                    ->label(trans('admin/servers.table.status'))
                    ->badge()
                    ->sortable(),

                TextColumn::make('egg.name')
                    ->label(trans('admin/servers.table.egg'))
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('memory')
                    ->label(trans('admin/servers.table.memory'))
                    ->numeric()
                    ->sortable()
                    // Change to Infinity and remove the MiB suffix if the value is 0 (which indicates no disk limit) and calculate size in GiB for values above or equal to 1024 MiB
                    ->formatStateUsing(function ($state) {
                        if ($state === 0) {
                            return '∞';
                        } elseif ($state >= 1024) {
                            return round($state / 1024, 2) . ' GiB';
                        } else {
                            return $state . ' MiB';
                        }
                    })
                    ->toggleable(),

                TextColumn::make('disk')
                    ->label(trans('admin/servers.table.disk'))
                    ->numeric()
                    ->sortable()
                    // Change to Infinity and remove the MiB suffix if the value is 0 (which indicates no disk limit) and calculate size in GiB for values above or equal to 1024 MiB
                    ->formatStateUsing(function ($state) {
                        if ($state === 0) {
                            return '∞';
                        } elseif ($state >= 1024) {
                            return round($state / 1024, 2) . ' GiB';
                        } else {
                            return $state . ' MiB';
                        }
                    })
                    ->toggleable(),

                TextColumn::make('cpu')
                    ->label(trans('admin/servers.table.cpu'))
                    ->numeric()
                    ->sortable()
                    // Change to Infinity and remove the percent suffix if the value is 0 (which indicates no CPU limit)
                    ->formatStateUsing(fn ($state) => $state === 0 ? '∞' : $state . ' %')
                    ->toggleable(),

                IconColumn::make('skip_scripts')
                    ->label(trans('admin/servers.fields.skip_scripts.label'))
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label(trans('admin/servers.table.created'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(trans('admin/servers.table.updated'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('installed_at')
                    ->label(trans('admin/servers.table.installed'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label(trans('admin/servers.actions.edit')),
                // Create an Action to open a new tab to the server's panel page
                ViewAction::make('view')
                    ->label(trans('admin/servers.actions.view'))
                    ->icon('heroicon-o-eye')
                    ->url(fn (Server $record) => config('app.url') . '/server/' . $record->uuid)
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(trans('admin/servers.actions.delete')),
                ]),
            ]);
    }
}
