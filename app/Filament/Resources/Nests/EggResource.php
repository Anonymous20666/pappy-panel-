<?php

namespace App\Filament\Resources\Nests;

use App\Models\Egg;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\Nests\Eggs\Pages;

class EggResource extends Resource
{
    protected static ?string $model = Egg::class;

    protected static ?string $slug = 'nests/egg';

    protected static bool $shouldRegisterNavigation = false;

    public static function getRecordRouteKeyName(): string
    {
        return 'id';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Tabs::make('Egg Configuration')
                    ->tabs([
                        \Filament\Schemas\Components\Tabs\Tab::make('configuration')
                            ->label('Configuration')
                            ->icon('tabler-settings-2')
                            ->schema([
                                \Filament\Schemas\Components\Section::make('Identity')
                                    ->schema([
                                        Forms\Components\Select::make('nest_id')
                                            ->label('Nest')
                                            ->relationship('nest', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->disabled(fn ($context) => $context === 'edit')
                                            ->dehydrated(),
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('uuid')
                                            ->label('UUID')
                                            ->disabled(),
                                        Forms\Components\TextInput::make('author')
                                            ->email()
                                            ->disabled(),
                                        Forms\Components\TextInput::make('banner')
                                            ->maxLength(191),
                                        Forms\Components\Textarea::make('description')
                                            ->columnSpanFull(),
                                    ])->columns(2),

                                \Filament\Schemas\Components\Section::make('Docker Images')
                                    ->description('The docker images available to servers using this egg. Enter one per line.')
                                    ->schema([
                                        Forms\Components\KeyValue::make('docker_images')
                                            ->required()
                                            ->live()
                                            ->keyLabel('Image Name')
                                            ->valueLabel('Image URI')
                                            ->addActionLabel('Add Docker Image')
                                            ->columnSpanFull(),
                                        Forms\Components\Toggle::make('force_outgoing_ip')
                                            ->label('Force Outgoing IP')
                                            ->helperText('Forces all outgoing network traffic to have its Source IP NATed to the IP of the server\'s primary allocation IP.'),
                                        Forms\Components\TagsInput::make('features')
                                            ->label('Features')
                                            ->helperText('Additional features belonging to the egg. Useful for configuring additional panel modifications.')
                                            ->columnSpanFull(),
                                    ]),

                                \Filament\Schemas\Components\Section::make('Process Management')
                                    ->schema([
                                        Forms\Components\Textarea::make('startup')
                                            ->label('Startup Command')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('config_stop')
                                            ->label('Stop Command'),
                                        Forms\Components\Select::make('config_from')
                                            ->label('Copy Settings From')
                                            ->relationship('configFrom', 'name')
                                            ->searchable()
                                            ->preload(),
                                        Forms\Components\Textarea::make('config_startup')
                                            ->label('Start Configuration (JSON)')
                                            ->json()
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('config_logs')
                                            ->label('Log Configuration (JSON)')
                                            ->json()
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('config_files')
                                            ->label('Configuration Files (JSON)')
                                            ->json()
                                            ->columnSpanFull(),
                                        Forms\Components\TagsInput::make('file_denylist')
                                            ->label('File Denylist')
                                            ->helperText('Files that should not be edited by the user.')
                                            ->columnSpanFull(),
                                    ])->columns(2),
                            ]),

                        \Filament\Schemas\Components\Tabs\Tab::make('variables')
                            ->label('Variables')
                            ->icon('tabler-variable')
                            ->schema([
                                Forms\Components\Repeater::make('variables')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('description')
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('env_variable')
                                            ->label('Environment Variable')
                                            ->required()
                                            ->maxLength(191),
                                        Forms\Components\TextInput::make('default_value')
                                            ->maxLength(191),
                                        Forms\Components\Toggle::make('user_viewable')
                                            ->label('Users Can View')
                                            ->default(true),
                                        Forms\Components\Toggle::make('user_editable')
                                            ->label('Users Can Edit')
                                            ->default(true),
                                        Forms\Components\TextInput::make('rules')
                                            ->label('Input Rules')
                                            ->required()
                                            ->maxLength(191),
                                    ])
                                    ->columns(2)
                                    ->defaultItems(0)
                                    ->reorderableWithButtons()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                            ]),

                        \Filament\Schemas\Components\Tabs\Tab::make('install_script')
                            ->label('Install Script')
                            ->icon('tabler-file-code')
                            ->schema([
                                Forms\Components\Textarea::make('script_install')
                                    ->label('Install Script')
                                    ->rows(10)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('script_container')
                                    ->label('Script Container')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\TextInput::make('script_entry')
                                    ->label('Script Entrypoint Command')
                                    ->required()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('copy_script_from')
                                    ->label('Copy Script From')
                                    ->relationship('scriptFrom', 'name')
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Toggle::make('script_is_privileged')
                                    ->label('Privileged')
                                    ->helperText('Run the install script as a privileged container (root).'),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('export')
                    ->label('Export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($record) {
                        $json = app(\App\Services\Eggs\Sharing\EggExporterService::class)->handle($record->id);
                        $filename = trim(preg_replace('/\W/', '-', kebab_case($record->name)), '-');
                        
                        return response()->streamDownload(function () use ($json) {
                            echo $json;
                        }, 'egg-' . $filename . '.json');
                    }),
                Tables\Actions\DeleteAction::make()
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
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
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'create' => Pages\CreateEgg::route('/create'),
            'edit' => Pages\EditEgg::route('/{record}'),
        ];
    }
}
