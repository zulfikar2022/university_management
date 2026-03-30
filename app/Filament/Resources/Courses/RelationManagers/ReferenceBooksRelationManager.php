<?php

namespace App\Filament\Resources\Courses\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ReferenceBooksRelationManager extends RelationManager
{
    protected static string $relationship = 'referenceBooks';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('BookName')
                    ->required(),
                TextInput::make('SI_No')
                    ->label('Serial Number')
                    ->required(),
                TextInput::make('Author')
                    ->required(),

               FileUpload::make('File')
                    ->label('Book PDF (Optional)')
                    ->disk('public')
                    ->directory('reference_books')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(20480)
                    ->downloadable()
                    ->openable()
                    ->nullable(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('BookName')
            ->columns([
                TextColumn::make('BookName')
                    ->searchable(),
                TextColumn::make('Author')
                    ->searchable(),
                TextColumn::make('SI_No')
                    ->label('Serial Number')

            ])
            ->filters([
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Book'),

            ])
            ->recordActions([
                Action::make('read_book')
                    ->label('Read Book')
                    ->icon('heroicon-o-book-open')
                    ->color('info')
                    ->url(fn ($record) => Storage::url($record->File))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => !empty($record->File)),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
            ]);
    }

    public function isReadOnly(): bool
    {
        // This tells Filament to ALWAYS allow actions, even on the View page!
        return false;
    }
}
