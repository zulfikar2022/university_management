<?php

namespace App\Filament\Resources\Buildings\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FloorsRelationManager extends RelationManager
{
    protected static string $relationship = 'floors';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('floor_number')
                    ->required()
                    ->numeric(),
                TextInput::make('total_rooms')
                    ->required()
                    ->numeric(),
                TextInput::make('usage')
                    ->required(),

                Repeater::make('rooms')
                    ->relationship()
                    ->schema([
                        TextInput::make('room_number')
                            ->numeric()
                            ->required(),
                        TextInput::make('room_type')
                            ->required()
                            ->label('Room Type (e.g., Lab, Lecture)'),
                        TextInput::make('room_size')
                            ->required()
                            ->label('Room Size ')
                            ->numeric(),
                        TextInput::make('available_seats')
                            ->label('Available Seats')
                            ->numeric()
                    ])
                    ->columns(2) // Puts the room inputs side-by-side
                    ->addActionLabel('Add Room')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('floor_number')
            ->columns([
                TextColumn::make('floor_number')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_rooms')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rooms_count')
                    ->counts('rooms')
                    ->label('Rooms Added')
                    ->sortable(),
                TextColumn::make('usage')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Floor')
                    ->icon('heroicon-o-plus')
                    ->createAnother(false),
            ])
            ->recordActions([
                EditAction::make(),
                // DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DissociateBulkAction::make(),
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }


}
