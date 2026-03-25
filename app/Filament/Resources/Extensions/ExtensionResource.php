<?php

namespace App\Filament\Resources\Extensions;

use App\Filament\Resources\Extensions\Pages\ListExtensions;
use App\Models\Extension;
use App\Services\Extensions\ExtensionManager;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExtensionResource extends Resource
{
    protected static ?string $model = Extension::class;

    protected static ?int $navigationSort = 1;
     
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static string|\BackedEnum|null $activeNavigationIcon = 'heroicon-s-puzzle-piece';

    public static function getNavigationGroup(): ?string
    {
        return trans('admin/navigation.service.title');
    }

    public static function getNavigationLabel(): string
    {
        return 'Extensions';
    }

    public static function getModelLabel(): string
    {
        return 'Extension';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Extensions';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identifier')
                    ->label('ID')
                    ->searchable(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('version'),

                TextColumn::make('author'),

                IconColumn::make('enabled')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime(),
            ])
            ->actions([
                Action::make('manifest')
                    ->label('Manifest')
                    ->icon('heroicon-o-document-text')
                    ->modalHeading('Extension Manifest')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->infolist([
                        \Filament\Infolists\Components\TextEntry::make('identifier')->label('Identifier'),
                        \Filament\Infolists\Components\TextEntry::make('name')->label('Name'),
                        \Filament\Infolists\Components\TextEntry::make('version')->label('Version'),
                        \Filament\Infolists\Components\TextEntry::make('manifest_json')
                            ->label('Manifest JSON')
                            ->state(fn (Extension $record) => json_encode($record->manifest ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)),
                    ]),

                Action::make('enable')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn (Extension $record): bool => !$record->enabled)
                    ->action(function (Extension $record): void {
                        try {
                            app(ExtensionManager::class)->enable($record->identifier);
                            Notification::make()->title('Extension enabled')->success()->send();
                        } catch (\Throwable $exception) {
                            Notification::make()->title('Enable failed')->body($exception->getMessage())->danger()->send();
                        }
                    }),

                Action::make('disable')
                    ->color('warning')
                    ->icon('heroicon-o-pause-circle')
                    ->visible(fn (Extension $record): bool => $record->enabled)
                    ->action(function (Extension $record): void {
                        try {
                            app(ExtensionManager::class)->disable($record->identifier);
                            Notification::make()->title('Extension disabled')->success()->send();
                        } catch (\Throwable $exception) {
                            Notification::make()->title('Disable failed')->body($exception->getMessage())->danger()->send();
                        }
                    }),

                DeleteAction::make()
                    ->label('Uninstall')
                    ->requiresConfirmation()
                    ->action(function (Extension $record): void {
                        try {
                            app(ExtensionManager::class)->remove($record->identifier);
                            Notification::make()->title('Extension uninstalled')->success()->send();
                        } catch (\Throwable $exception) {
                            Notification::make()->title('Uninstall failed')->body($exception->getMessage())->danger()->send();
                        }
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExtensions::route('/'),
        ];
    }
}
