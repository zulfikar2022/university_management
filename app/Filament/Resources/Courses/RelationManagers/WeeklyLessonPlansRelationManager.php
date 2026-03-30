<?php

namespace App\Filament\Resources\Courses\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WeeklyLessonPlansRelationManager extends RelationManager
{
    protected static string $relationship = 'weeklyLessonPlans';

    // stop create and create another
    protected function canCreateAnother(): bool
    {
        return true;
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('weekNo')
                    ->label('Week Number')
                    ->required()
                    ->numeric(),
                Textarea::make('topics')
                    ->label('Topics Covered')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('specificOutcomes')
                    ->label('Specific Outcomes')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('teachingStrategy')
                    ->label('Teaching Strategy')
                    ->required(),
                TextInput::make('teachingAid')
                    ->label('Teaching Aid')
                    ->required(),
                TextInput::make('assessmentStrategy')
                    ->label('Assessment Strategy')
                    ->required(),
                TextInput::make('CLO_mapping')
                    ->label('CLO Mapping')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('weekNo')
            ->columns([
                TextColumn::make('weekNo')
                    ->label('Week Number')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('teachingStrategy')
                    ->label('Teaching Strategy')
                    ->searchable(),
                TextColumn::make('teachingAid')
                    ->label('Teaching Aid')
                    ->searchable(),
                TextColumn::make('assessmentStrategy')
                    ->label('Assessment Strategy')
                    ->searchable(),
                TextColumn::make('CLO_mapping')
                    ->label('CLO Mapping')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Weekly Lesson Plan')
                    ->icon(Heroicon::Plus)
                    ->createAnother(false),
                // AssociateAction::make(),
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
