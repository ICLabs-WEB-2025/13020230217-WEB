<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\FieldsList;
use App\Filament\Widgets\FieldsOverview;
use App\Filament\Widgets\ScheduleOverview;
use Filament\Pages\Page;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected function getFooterWidgets(): array
    {
        return [
            FieldsList::class,
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            FieldsOverview::class,
            ScheduleOverview::class,
        ];
    }

    
}