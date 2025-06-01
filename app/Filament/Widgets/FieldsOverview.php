<?php

namespace App\Filament\Widgets;

use App\Models\Field;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FieldsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Lapangan', Field::count())
                ->description('Jumlah lapangan yang tersedia')
                ->descriptionIcon('heroicon-o-rectangle-stack')
                ->color('success'),
            Stat::make('Lapangan Aktif', Field::where('is_active', true)->count())
                ->description('Lapangan yang tersedia untuk booking')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('primary'),
            Stat::make('Lapangan Nonaktif', Field::where('is_active', false)->count())
                ->description('Lapangan yang sedang tidak tersedia')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}