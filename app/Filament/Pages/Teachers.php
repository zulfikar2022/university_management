<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class Teachers extends Page implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;
    protected string $view = 'filament.pages.teachers';
    protected static string|UnitEnum|null $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Pencil;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->whereHas('roles', function ($query) {
                $query->where('name', 'Teacher');
            }))
            ->columns([
                ImageColumn::make('profile_image')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(asset('images/user.png')),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('teacher.faculty.name')->label('Faculty')
                    ->searchable(),
                TextColumn::make('blood_group')->label('Blood Group')
                    ->searchable()
                    ->badge(),
            ])
            ->filters([
                // ...
            ])
            ->recordActions([
                // ...
            ])
            ->toolbarActions([
                // ...
            ]);
    }
}
