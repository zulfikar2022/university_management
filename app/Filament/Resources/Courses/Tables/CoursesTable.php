<?php

namespace App\Filament\Resources\Courses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('courseTitle')
                    ->searchable(),
                TextColumn::make('courseCode')
                    ->searchable(),
                TextColumn::make('department.dept_code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('level')
                    ->sortable(),
                TextColumn::make('semester')
                    ->sortable(),
                TextColumn::make('credit')
                    ->badge()
                    ->sortable()


            ])
            ->filters([
                SelectFilter::make('semester')
                    ->options([
                        'I' => 'One',
                        'II' => 'Two'
                    ])
                    ->multiple()
                    ->native(false),
                 SelectFilter::make('level')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5'
                    ])
                    ->multiple()
                    ->native(false),
                SelectFilter::make('department')
                    ->relationship('department', 'dept_code')
                    ->multiple()
                    ->native(false),

            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
            ]);
    }
}
