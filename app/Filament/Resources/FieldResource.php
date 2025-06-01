<?php

   namespace App\Filament\Resources;

   use App\Filament\Resources\FieldResource\Pages;
   use App\Models\Field;
   use Filament\Forms;
   use Filament\Resources\Resource;
   use Filament\Tables;
   use Filament\Forms\Form;
   use Filament\Tables\Table;

   class FieldResource extends Resource
   {
       protected static ?string $model = Field::class;
       protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
       protected static ?string $navigationLabel = 'Kelola Lapangan';

       public static function form(Form $form): Form
       {
           return $form
               ->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto Lapangan')
                        ->image()
                        ->directory('field_photos') // Menyimpan di folder field_photos
                        ->imageEditor() // Aktifkan editor gambar
                        ->maxSize(2048) // Batas ukuran file 2MB
                        ->columnSpanFull()
                        ->nullable(),
                   Forms\Components\TextInput::make('name')
                       ->label('Nama Lapangan')
                       ->required()
                       ->unique(ignoreRecord: true),
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
                       ->required(),
                   Forms\Components\Textarea::make('description')
                       ->label('Deskripsi')
                       ->nullable(),
                   Forms\Components\FileUpload::make('photo')
                       ->label('Foto Lapangan')
                       ->image()
                       ->nullable(),
                   Forms\Components\Toggle::make('is_active')
                       ->label('Aktif')
                       ->default(true),
               ]);
       }

       public static function table(Table $table): Table
       {
           return $table
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
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Futsal' => 'primary',
                            'Badminton' => 'success',
                            'Basket' => 'danger',
                            default => 'gray',
                        }),
                        
                    Tables\Columns\TextColumn::make('price_per_hour')
                        ->label('Harga/Jam')
                        ->money('IDR') 
                        ->sortable(),
                        
                    Tables\Columns\IconColumn::make('is_active')
                        ->label('Status')
                        ->boolean()
                        ->trueIcon('heroicon-o-check-circle')
                        ->falseIcon('heroicon-o-x-circle')
                        ->trueColor('success')
                        ->falseColor('danger'),
               ])
               ->filters([
                   Tables\Filters\SelectFilter::make('sport_type')
                        ->label('Filter Jenis Olahraga')
                        ->options([
                            'Futsal' => 'Futsal',
                            'Badminton' => 'Badminton',
                            'Basket' => 'Basket',
                        ]),
                        
                    Tables\Filters\TernaryFilter::make('is_active')
                        ->label('Status Aktif')
                        ->trueLabel('Aktif')
                        ->falseLabel('Nonaktif'),
               ])
               ->actions([
                   Tables\Actions\EditAction::make(),
                   Tables\Actions\DeleteAction::make()->requiresConfirmation(),
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
               'edit' => Pages\EditField::route('/{record}/edit'),
           ];
       }
   }