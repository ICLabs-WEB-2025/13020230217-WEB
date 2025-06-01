<?php

namespace App\Filament\Widgets;

use App\Models\Schedule;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ScheduleOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Schedule::query()->with(['field', 'user']))
            ->columns([
                Tables\Columns\TextColumn::make('field.name')
                    ->label('Lapangan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemesan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('booking_date')
                    ->label('Tanggal')
                    ->date(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Waktu Mulai'),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Waktu Selesai'),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ]);
    }
}