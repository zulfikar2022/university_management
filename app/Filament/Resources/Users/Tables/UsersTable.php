<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_image')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(asset('images/user.png')),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->badge()
                    ->label('User Roles')
                    ->colors([
                        'danger' => 'super_admin',
                        'warning' => 'Teacher',
                        'success' => 'Student',
                        'info' => 'Hall Staff',
                    ])
                    ->searchable(),

                TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                TextColumn::make('nationality')
                    ->searchable(),
                TextColumn::make('blood_group')
                    ->searchable()
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                ViewAction::make()
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
