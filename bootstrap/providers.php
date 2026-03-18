<?php

use App\Providers\ActivityLogServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\BackupsServiceProvider;
use App\Providers\BladeServiceProvider;
use App\Providers\EventServiceProvider;
use App\Providers\HashidsServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\RouteServiceProvider;
use App\Providers\RepositoryServiceProvider;
use App\Providers\ViewComposerServiceProvider;
use Prologue\Alerts\AlertsServiceProvider;

return [
    ActivityLogServiceProvider::class,
    AppServiceProvider::class,
    AuthServiceProvider::class,
    BackupsServiceProvider::class,
    BladeServiceProvider::class,
    EventServiceProvider::class,
    HashidsServiceProvider::class,
    AdminPanelProvider::class,
    RouteServiceProvider::class,
    RepositoryServiceProvider::class,
    ViewComposerServiceProvider::class,

    AlertsServiceProvider::class,
];
