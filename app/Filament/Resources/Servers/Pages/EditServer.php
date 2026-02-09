<?php

namespace App\Filament\Resources\Servers\Pages;

use App\Exceptions\DisplayException;
use App\Filament\Resources\Servers\ServerResource;
use App\Models\Server;
use App\Models\User;
use App\Repositories\Eloquent\ServerRepository;
use App\Services\Servers\BuildModificationService;
use App\Services\Servers\DetailsModificationService;
use App\Services\Servers\ReinstallServerService;
use App\Services\Servers\ServerDeletionService;
use App\Services\Servers\StartupModificationService;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditServer extends EditRecord
{
    protected static string $resource = ServerResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $detailsData = Arr::only($data, ['external_id', 'owner_id', 'name', 'description']);

        if (!empty($detailsData)) {
            app(DetailsModificationService::class)->handle($record, $detailsData);
        }

        $buildKeys = ['allocation_id', 'memory', 'swap', 'io', 'cpu', 'threads', 'disk', 'database_limit', 'allocation_limit', 'backup_limit', 'oom_disabled'];
        $buildData = Arr::only($data, $buildKeys);

        $desiredAdditional = $data['allocation_additional'] ?? [];
        $currentAdditional = $record->allocations()
            ->where('id', '!=', $record->allocation_id)
            ->pluck('id')
            ->all();

        $buildData['add_allocations'] = array_values(array_diff($desiredAdditional, $currentAdditional));
        $buildData['remove_allocations'] = array_values(array_diff($currentAdditional, $desiredAdditional));

        app(BuildModificationService::class)->handle($record, $buildData);

        $startupData = [
            'egg_id' => $data['egg_id'] ?? $record->egg_id,
            'startup' => $data['startup'] ?? $record->startup,
            'skip_scripts' => $data['skip_scripts'] ?? false,
            'docker_image' => $data['image'] ?? $record->image,
            'environment' => $data['environment'] ?? [],
        ];

        app(StartupModificationService::class)
            ->setUserLevel(User::USER_LEVEL_ADMIN)
            ->handle($record, $startupData);

        return $record->refresh();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('switch_install_status')
                ->label(trans('admin/server.actions.toggle_install_status'))
                ->color('primary')
                ->action(function () {
                    /** @var Server $server */
                    $server = $this->record;

                    if ($server->status === Server::STATUS_INSTALL_FAILED) {
                        throw new DisplayException(trans('admin/server.exceptions.marked_as_failed'));
                    }

                    app(ServerRepository::class)->update($server->id, [
                        'status' => $server->isInstalled() ? Server::STATUS_INSTALLING : null,
                    ], true, true);
                })
                ->successNotificationTitle(trans('admin/server.alerts.install_toggled')),

            Action::make('suspend')
                ->label(fn () => $this->record->isSuspended() ? trans('admin/server.actions.unsuspend') : trans('admin/server.actions.suspend'))
                ->color(fn () => $this->record->isSuspended() ? 'success' : 'warning')
                ->requiresConfirmation()
                ->action(fn () => app(ServerRepository::class)->suspend($this->record->id))
                ->successNotificationTitle(trans('admin/server.alerts.server_suspended', ['action' => $this->record->isSuspended() ? trans('admin/server.actions.unsuspended') : trans('admin/server.actions.suspended')])),

            Action::make('reinstall')
                ->label(trans('admin/server.actions.reinstall'))
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn () => app(ReinstallServerService::class)->handle($this->record))
                ->successNotificationTitle(trans('admin/server.alerts.server_reinstalled')),

            Action::make('delete')
                ->label(trans('admin/server.actions.delete'))
                ->color('danger')
                ->requiresConfirmation()
                ->action(function (Action $action) {
                    try {
                        app(ServerDeletionService::class)->handle($this->record);
                    } catch (\Throwable $e) {
                        $action->failure();
                    }
                })
                ->successNotificationTitle(trans('admin/server.alerts.server_deleted'))
                ->failureNotificationTitle(trans('admin/server.alerts.server_delete_failed'))
                ->successRedirectUrl($this->getResource()::getUrl('index')),

            Action::make('delete_forcibly')
                ->label(trans('admin/server.actions.delete_forcibly'))
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn () => app(ServerDeletionService::class)->withForce()->handle($this->record))
                ->successNotificationTitle(trans('admin/server.alerts.server_deleted'))
                ->successRedirectUrl($this->getResource()::getUrl('index')),

            Action::make('view')
                ->label(trans('admin/server.actions.view'))
                ->url(fn () => config('app.url') . '/server/' . $this->record->uuid)
                ->openUrlInNewTab(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
