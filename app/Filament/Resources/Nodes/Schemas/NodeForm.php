<?php

namespace App\Filament\Resources\Nodes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(trans('admin/nodes.sections.identity.title'))
                    ->description(trans('admin/nodes.sections.identity.description'))
                    ->schema([
                        TextInput::make('name')
                            ->label(trans('admin/nodes.fields.name.label'))
                            ->required()
                            ->maxLength(100)
                            ->placeholder(trans('admin/nodes.fields.name.placeholder'))
                            ->helperText(trans('admin/nodes.fields.name.helper'))
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label(trans('admin/nodes.fields.description.label'))
                            ->placeholder(trans('admin/nodes.fields.description.placeholder'))
                            ->helperText(trans('admin/nodes.fields.description.helper'))
                            ->columnSpanFull(),

                        Select::make('location_id')
                            ->label(trans('admin/nodes.fields.location.label'))
                            ->relationship('location', 'short')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText(trans('admin/nodes.fields.location.helper'))
                            ->columnSpanFull(),

                        Toggle::make('public')
                            ->label(trans('admin/nodes.fields.public.label'))
                            ->default(true)
                            ->helperText(trans('admin/nodes.fields.public.helper')),

                        Toggle::make('maintenance_mode')
                            ->label(trans('admin/nodes.fields.maintenance_mode.label'))
                            ->default(false)
                            ->helperText(trans('admin/nodes.fields.maintenance_mode.helper')),
                    ])
                    ->columns(2),

                Section::make(trans('admin/nodes.sections.resources.title'))
                    ->description(trans('admin/nodes.sections.resources.description'))
                    ->schema([
                        TextInput::make('memory')
                            ->label(trans('admin/nodes.fields.memory.label'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->suffix('MiB')
                            ->helperText(trans('admin/nodes.fields.memory.helper')),

                        TextInput::make('memory_overallocate')
                            ->label(trans('admin/nodes.fields.memory_overallocate.label'))
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->suffix('%')
                            ->helperText(trans('admin/nodes.fields.memory_overallocate.helper')),

                        TextInput::make('disk')
                            ->label(trans('admin/nodes.fields.disk.label'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->suffix('MiB')
                            ->helperText(trans('admin/nodes.fields.disk.helper')),

                        TextInput::make('disk_overallocate')
                            ->label(trans('admin/nodes.fields.disk_overallocate.label'))
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->suffix('%')
                            ->helperText(trans('admin/nodes.fields.disk_overallocate.helper')),

                        TextInput::make('upload_size')
                            ->label(trans('admin/nodes.fields.upload_size.label'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(100)
                            ->suffix('MiB')
                            ->helperText(trans('admin/nodes.fields.upload_size.helper')),
                    ])
                    ->columns(2),
                
                Section::make(trans('admin/nodes.sections.daemon.title'))
                    ->description(trans('admin/nodes.sections.daemon.description'))
                    ->schema([
                        TextInput::make('daemonBase')
                            ->label(trans('admin/nodes.fields.daemon_base.label'))
                            ->required()
                            ->maxLength(255)
                            ->default('/var/lib/pterodactyl/volumes')
                            ->placeholder(trans('admin/nodes.fields.daemon_base.placeholder'))
                            ->helperText(trans('admin/nodes.fields.daemon_base.helper')),

                        TextInput::make('daemonListen')
                            ->label(trans('admin/nodes.fields.daemon_listen.label'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(65535)
                            ->default(8080)
                            ->helperText(trans('admin/nodes.fields.daemon_listen.helper')),

                        TextInput::make('daemonSFTP')
                            ->label(trans('admin/nodes.fields.daemon_sftp.label'))
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(65535)
                            ->default(2022)
                            ->helperText(trans('admin/nodes.fields.daemon_sftp.helper')),

                        TextInput::make('containerText')
                            ->label(trans('admin/nodes.fields.container_text.label'))
                            ->maxLength(50)
                            ->default('container@reviactyl~')
                            ->helperText(trans('admin/nodes.fields.container_text.helper')),

                        TextInput::make('daemonText')
                            ->label(trans('admin/nodes.fields.daemon_text.label'))
                            ->maxLength(50)
                            ->default('[Reviactyl Daemon]:')
                            ->helperText(trans('admin/nodes.fields.daemon_text.helper')),
                    ])
                    ->columns(2),

                Section::make(trans('admin/nodes.sections.connection.title'))
                    ->description(trans('admin/nodes.sections.connection.description'))
                    ->schema([
                        TextInput::make('fqdn')
                            ->label(trans('admin/nodes.fields.fqdn.label'))
                            ->required()
                            ->maxLength(255)
                            ->placeholder(trans('admin/nodes.fields.fqdn.placeholder'))
                            ->helperText(trans('admin/nodes.fields.fqdn.helper'))
                            ->columnSpanFull(),

                        Toggle::make('scheme')
                            ->label(trans('admin/nodes.fields.ssl.label'))
                            ->default(true)
                            ->disabled(fn () => request()->secure())
                            ->dehydrated(true)
                            ->afterStateHydrated(function ($component, $state, $record) {
                                $isSecure = request()->secure();
                                
                                // Force HTTPS if panel is running on HTTPS
                                if ($isSecure) {
                                    $component->state(true);
                                    return;
                                }
                                
                                if ($record && isset($record->scheme)) {
                                    $component->state($record->scheme === 'https');
                                } elseif (is_string($state)) {
                                    // Fallback: convert string to boolean
                                    $component->state($state === 'https');
                                }
                            })
                            ->dehydrateStateUsing(fn ($state) => $state ? 'https' : 'http')
                            ->helperText(fn () => request()->secure() 
                                ? trans('admin/nodes.fields.ssl.helper_forced')
                                : trans('admin/nodes.fields.ssl.helper')),

                        Toggle::make('behind_proxy')
                            ->label(trans('admin/nodes.fields.behind_proxy.label'))
                            ->default(false)
                            ->helperText(trans('admin/nodes.fields.behind_proxy.helper')),
                    ])
                    ->columns(2),

                    // TODO: Possibly add a button for auto-deploying this node
            ]);
    }
}
