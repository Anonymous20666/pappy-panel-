<?php

use App\Console\Kernel as ConsoleKernel;
use App\Exceptions\Handler as ExceptionHandler;
use App\Http\Kernel as HttpKernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Foundation\Application;

$app = Application::configure(basePath: $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));

if (!empty($_ENV['APP_STORAGE_PATH'])) {
    $app->useStoragePath($_ENV['APP_STORAGE_PATH']);
}

return $app
    ->withProviders()
    ->withExceptions()
    ->withSingletons([
        HttpKernelContract::class => HttpKernel::class,
        ConsoleKernelContract::class => ConsoleKernel::class,
        ExceptionHandlerContract::class => ExceptionHandler::class,
    ])
    ->create();
