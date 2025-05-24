<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FieldResource\Pages;
use App\Models\Field;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FieldResource extends Resource
{
    protected static ?string $model = Field::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kelola Lapangan';
    protected static ?string $modelLabel = 'Lapangan';
    protected static ?string $navigationGroup = 'Manajemen Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lapangan')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpan(2),
                        Forms\Components\Select::make('sport_type')
                            ->label('Jenis Olahraga')
                            ->options([
                                'Futsal' => 'Futsal',
                                'Badminton' => 'Badminton',
                                'Basket' => 'Basket',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('price_per_hour')
                            ->label('Harga per Jam')
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(10000)
                            ->thousandsSeparator('.')
                            ->required(),
                    ])->columns(3),
                    
                Forms\Components\Section::make('Detail Tambahan')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->nullable()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto Lapangan')
                            ->image()
                            ->directory('field_photos')
                            ->imageEditor()
                            ->multiple()
                            ->maxFiles(5)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => asset('images/default-field.jpg')),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lapangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sport_type')
                    ->label('Jenis Olahraga')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Futsal' => 'primary',
                        'Badminton' => 'success',
                        'Basket' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Harga per Jam')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Status')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sport_type')
                    ->label('Jenis Olahraga')
                    ->options([
                        'Futsal' => 'Futsal',
                        'Badminton' => 'Badminton',
                        'Basket' => 'Basket',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Lapangan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus lapangan ini?'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFields::route('/'),
            'create' => Pages\CreateField::route('/create'),
            'view' => Pages\ViewField::route('/{record}'),
            'edit' => Pages\EditField::route('/{record}/edit'),
        ];
    }
}

//    namespace App\Filament\Resources;

//    use App\Filament\Resources\FieldResource\Pages;
//    use App\Models\Field;
//    use Filament\Forms;
//    use Filament\Resources\Resource;
//    use Filament\Tables;
//    use Filament\Forms\Form;
//    use Filament\Tables\Table;

//    class FieldResource extends Resource
//    {
//        protected static ?string $model = Field::class;
//        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
//        protected static ?string $navigationLabel = 'Kelola Lapangan';

//        public static function form(Form $form): Form
//        {
//            return $form
//                ->schema([
//                    Forms\Components\TextInput::make('name')
//                        ->label('Nama Lapangan')
//                        ->required()
//                        ->unique(ignoreRecord: true),
//                    Forms\Components\Select::make('sport_type')
//                        ->label('Jenis Olahraga')
//                        ->options([
//                            'Futsal' => 'Futsal',
//                            'Badminton' => 'Badminton',
//                            'Basket' => 'Basket',
//                        ])
//                        ->required(),
//                    Forms\Components\TextInput::make('price_per_hour')
//                        ->label('Harga per Jam')
//                        ->numeric()
//                        ->required(),
//                    Forms\Components\Textarea::make('description')
//                        ->label('Deskripsi')
//                        ->nullable(),
//                    Forms\Components\FileUpload::make('photo')
//                        ->label('Foto Lapangan')
//                        ->image()
//                        ->nullable(),
//                    Forms\Components\Toggle::make('is_active')
//                        ->label('Aktif')
//                        ->default(true),
//                ]);
//        }

//        public static function table(Table $table): Table
//        {
//            return $table
//                ->columns([
//                    Tables\Columns\TextColumn::make('name')->label('Nama Lapangan'),
//                    Tables\Columns\TextColumn::make('sport_type')->label('Jenis Olahraga'),
//                    Tables\Columns\TextColumn::make('price_per_hour')->label('Harga per Jam'),
//                    Tables\Columns\BooleanColumn::make('is_active')->label('Aktif'),
//                ])
//                ->filters([
//                    //
//                ])
//                ->actions([
//                    Tables\Actions\EditAction::make(),
//                    Tables\Actions\DeleteAction::make()->requiresConfirmation(),
//                ])
//                ->bulkActions([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]);
//        }

//        public static function getPages(): array
//        {
//            return [
//                'index' => Pages\ListFields::route('/'),
//                'create' => Pages\CreateField::route('/create'),
//                'edit' => Pages\EditField::route('/{record}/edit'),
//            ];
//        }
//    }