<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected static string|\BackedEnum|null $activeNavigationIcon = 'heroicon-s-home';

    public function getHeading(): string
    {
        return trans('admin/index.title');
    }

    public function getColumns(): int|array
    {
        return 1;
    }
}