<?php

namespace App\Filament\Resources\Faculties;

use App\Filament\Resources\Faculties\Pages\ManageFaculties;
use App\Models\Faculty;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class FacultyResource extends Resource
{
    protected static ?string $model = Faculty::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Academia Management';
    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('short_name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('short_name')
                    ->searchable(),

                TextColumn::make('number_of_degrees')
                    ->label('Degrees')
                    ->badge()
                    ->color('primary')
                    ->getStateUsing(function (Faculty $record) {
                        return $record->degrees()->count();
                    })
                    ->searchable(),

                TextColumn::make('number_of_departments')
                    ->label('Departments')
                    ->badge()
                    ->color('success')
                    ->getStateUsing(function (Faculty $record) {
                        return $record->departments()->count();
                    })
                    ->searchable(),

                TextColumn::make('number_of_teachers')
                    ->label('Teachers')
                    ->badge()
                    ->color('warning')
                    ->getStateUsing(function (Faculty $record) {
                        return $record->teachers()->count();
                    })
                    ->searchable(),

                TextColumn::make('number_of_students')
                    ->label('Students')
                    ->badge()
                    ->color('success')
                    ->getStateUsing(function (Faculty $record) {
                        return $record->students()->count();
                    })
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                // DeleteAction::make(),
            ])
            ->toolbarActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageFaculties::route('/'),
        ];
    }
}
