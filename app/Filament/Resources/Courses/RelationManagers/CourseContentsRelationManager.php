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
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;

class CourseContentsRelationManager extends RelationManager
{
    protected static string $relationship = 'courseContents';

    public function isReadOnly(): bool
    {
        // This tells Filament to ALWAYS allow actions, even on the View page!
        return false;
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Content Details')
                    ->schema([
                        TextEntry::make('content')
                            ->label('Course Content')
                            ->columnSpanFull(),

                        TextEntry::make('teaching_strategy')
                            ->label('Teaching Strategy')
                            ->columnSpanFull(),

                        TextEntry::make('assessment_strategy')
                            ->label('Assessment Strategy')
                            ->columnSpanFull(),

                        TextEntry::make('CLO_mapping')
                            ->label('CLO Mapping')
                            ->columnSpanFull(),
                    ])->columnSpanFull()
            ]);
    }


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('teaching_strategy')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('assessment_strategy')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('CLO_mapping')
                    ->label('CLO Mapping')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('content')
            ->columns([
                TextColumn::make('content')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('teaching_strategy')
                    ->limit(50)
                    ->label('Teaching Strategy')
                    ->searchable(),
                TextColumn::make('assessment_strategy')
                    ->limit(50)
                    ->label('Assessment Strategy')
                    ->searchable(),
                TextColumn::make('CLO_mapping')
                    ->limit(50)
                    ->label('CLO Mapping')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Content')
                    ->icon('heroicon-o-plus')
                    ->createAnother(false),
                // AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
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
