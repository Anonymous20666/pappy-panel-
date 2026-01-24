<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static string|\BackedEnum|null $activeNavigationIcon = 'heroicon-s-squares-2x2';

    public function getHeading(): string
    {
        return trans('admin/index.title');
    }

    public static function getNavigationLabel(): string
    {
        return trans('admin/navigation.administration.dashboard');
    }

    public function getTitle(): string
    {
        return trans('admin/index.title');
    }
}