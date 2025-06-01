<?php

   namespace App\Filament\Resources;

   use App\Filament\Resources\ScheduleResource\Pages;
   use App\Models\Schedule;
   use Filament\Forms;
   use Filament\Resources\Resource;
   use Filament\Tables;
   use Filament\Forms\Form;
   use Filament\Tables\Table;
   use Illuminate\Database\Eloquent\Builder; // Tambahkan baris ini jika belum ada
use Illuminate\Database\Eloquent\SoftDeletingScope;

   class ScheduleResource extends Resource
   {
       protected static ?string $model = Schedule::class;
       protected static ?string $navigationIcon = 'heroicon-o-calendar';
       protected static ?string $navigationLabel = 'Kelola Jadwal';

       public static function form(Form $form): Form
       {
           return $form
               ->schema([
                   Forms\Components\Select::make('field_id')
                       ->label('Lapangan')
                       ->relationship('field', 'name')
                       ->required(),
                   Forms\Components\DatePicker::make('date')
                       ->label('Tanggal')
                       ->required(),
                   Forms\Components\TimePicker::make('start_time')
                       ->label('Waktu Mulai')
                       ->required(),
                   Forms\Components\TimePicker::make('end_time')
                       ->label('Waktu Selesai')
                       ->required(),
                   Forms\Components\Select::make('status')
                       ->label('Status')
                       ->options([
                           'Tersedia' => 'Tersedia',
                           'Tidak Tersedia' => 'Tidak Tersedia',
                           'Dipesan' => 'Dipesan',
                       ])
                       ->required(),
               ]);
       }

       public static function table(Table $table): Table
       {
           return $table
           ->query(Schedule::query()->withoutGlobalScope(SoftDeletingScope::class))    
           ->columns([
                   Tables\Columns\TextColumn::make('field.name')->label('Lapangan'),
                   Tables\Columns\TextColumn::make('date')->label('Tanggal'),
                   Tables\Columns\TextColumn::make('start_time')->label('Waktu Mulai'),
                   Tables\Columns\TextColumn::make('end_time')->label('Waktu Selesai'),
                   Tables\Columns\TextColumn::make('status')->label('Status'),
               ])
               ->filters([
                   //
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
               'index' => Pages\ListSchedules::route('/'),
               'create' => Pages\CreateSchedule::route('/create'),
               'edit' => Pages\EditSchedule::route('/{record}/edit'),
           ];
       }
   }