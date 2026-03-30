<?php

namespace App\Filament\Resources\Degrees;

use App\Filament\Resources\Degrees\Pages\ManageDegrees;
use App\Models\Degree;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class DegreeResource extends Resource
{
    protected static ?string $model = Degree::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CheckBadge;
    protected static string|UnitEnum|null $navigationGroup = 'Academia Management';
    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('fauclty')
                    ->relationship('faculty', 'name')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('credit_hours')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('faculty.name')
                    ->sortable(),
                TextColumn::make('credit_hours')
                    ->numeric()
                    ->sortable(),
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
            'index' => ManageDegrees::route('/'),
        ];
    }
}
