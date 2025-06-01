<?php

namespace App\Filament\Widgets;

use App\Models\Field;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class FieldsList extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Field::query())
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public') 
                    ->defaultImageUrl(asset('images/default-field.jpg')) 
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lapangan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sport_type')
                    ->label('Jenis Olahraga')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Harga per Jam')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }
}