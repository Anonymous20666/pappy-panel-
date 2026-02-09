<?php

namespace App\Filament\Resources\Nodes\Tables;

use App\Models\Node;
use App\Repositories\Wings\DaemonConfigurationRepository;
use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;

class NodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
                IconColumn::make('health')
                    ->label('Health')
                    ->trueIcon('heroicon-s-heart')
                    ->falseIcon('heroicon-o-heart')
                    ->state(function (Node $record): bool {
                        return Cache::remember(
                            'nodes.health.' . $record->id,
                            now()->addSeconds(5), // No need to check health more than once every 5 seconds
                            function () use ($record): bool {
                                try {
                                    // TODO: Consider if the CLIENT's Health should be used here because of CORS Errors otherwise being hard to debug
                                    app(DaemonConfigurationRepository::class)
                                        ->setNode($record)
                                        ->getSystemInformation(2);
                
                                    return true;
                                } catch (\Throwable) {
                                    return false;
                                }
                            }
                        );
                    })
                    ->boolean()
                    ->sortable(),
                    
                TextColumn::make('name')
                    ->label(trans('admin/node.table.name'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                    
                TextColumn::make('location.short')
                    ->label(trans('admin/node.table.location'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('id')
                    ->label(trans('admin/node.table.id'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('fqdn')
                    ->label(trans('admin/node.table.fqdn'))
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('behind_proxy')
                    ->label(trans('admin/node.table.behind_proxy'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('memory')
                    ->label(trans('admin/node.table.memory'))
                    ->numeric()
                    ->sortable()
                    ->suffix(' MiB')
                    ->toggleable(),

                TextColumn::make('disk')
                    ->label(trans('admin/node.table.disk'))
                    ->numeric()
                    ->sortable()
                    ->suffix(' MiB')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label(trans('admin/node.table.created'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->label(trans('admin/node.table.updated'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('servers_count')
                    ->label(trans('admin/node.table.servers'))
                    ->counts('servers')
                    ->sortable(),

                IconColumn::make('maintenance_mode')
                    ->label(trans('admin/node.table.maintenance_mode'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('public')
                    ->label(trans('admin/node.table.public'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make()
                    ->label(trans('admin/node.actions.edit')),
                Actions\DeleteAction::make()
                    ->label(trans('admin/node.actions.delete')),
            ])
            /*->recordActions([
                EditAction::make()
                    ->label(trans('admin/node.actions.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(trans('admin/node.actions.delete')),
                ]),
            ])*/;
    }
}
