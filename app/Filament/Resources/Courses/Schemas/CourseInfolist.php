<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Symfony\Component\HttpFoundation\Session\SessionFactoryInterface;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Group::make()
                            ->schema([
                                TextEntry::make('courseTitle')
                                    ->inlineLabel(),
                                TextEntry::make('courseCode')
                                    ->inlineLabel(),
                                TextEntry::make('credit')
                                    ->label('Course Credit')
                                    ->inlineLabel(),
                                TextEntry::make('department.name')
                                    ->label('Department')
                                    ->inlineLabel(),
                                TextEntry::make('degree.name')
                                    ->label('Degree')
                                    ->inlineLabel(),

                        ]),
                        Group::make()
                            ->schema([
                                TextEntry::make('level')
                                    ->inlineLabel(),
                                TextEntry::make('semester')
                                    ->inlineLabel(),
                                TextEntry::make('academicSession')
                                    ->inlineLabel(),
                                TextEntry::make('type')
                                    ->inlineLabel(),
                                TextEntry::make('type_T_S')
                                    ->label('type_T_S')
                                    ->inlineLabel(),
                            ])
                    ])->columns(2),
                            TextEntry::make('totalMarks')
                                ->visible(fn ($state) => !empty($state))
                                ->inlineLabel(),
                            TextEntry::make('instructor')
                                ->visible(fn ($state) => !empty($state))
                                ->inlineLabel(),
                            TextEntry::make('prerequisite')
                                ->visible(fn ($state) => !empty($state))
                                ->inlineLabel(),
                            TextEntry::make('summary')
                                ->visible(fn ($state) => !empty($state))
                                ->inlineLabel(),

                        Section::make('Course Objective')
                            ->headerActions([
                                Action::make('Add Course Objective')
                                    ->link()
                                    ->visible(fn ($record) => empty($record->courseObjective))
                                    ->icon(Heroicon::Plus)
                                    ->schema([
                                        Textarea::make('CO_Description')
                                            ->label('Course Objective Description')
                                    ])
                                    ->action(function (array $data, $record, \Livewire\Component $livewire) {
                                        $record->courseObjective()->create($data);
                                        $livewire->js('window.location.reload()');
                                    }),

                                Action::make('Edit Course Objective')
                                    ->label('Edit Course Objective')
                                    ->link()
                                    ->visible(fn ($record) => !empty($record->courseObjective))
                                     ->fillForm(fn ($record) => $record->courseObjective->toArray())
                                    ->schema([
                                        Textarea::make('CO_Description')
                                            ->label('Course Objective Description'),
                                    ])
                                    ->action(function (array $data, $record, \Livewire\Component $livewire) {
                                        $record->courseObjective()->update($data);
                                        $livewire->js('window.location.reload()');
                                    })
                                    ->icon(Heroicon::Pencil),
                            ])
                            ->schema([
                                TextEntry::make('courseObjective.CO_Description')
                                    ->label('CO_Description')
                                    ->inlineLabel()
                            ]),
                         Section::make('Course Learning Outcome')
                            ->headerActions([
                                Action::make('Add Course Learning Outcome')
                                    ->link()
                                    ->visible(fn ($record) => empty($record->courseLearningOutcome))
                                    ->icon(Heroicon::Plus)
                                    ->schema([
                                        Textarea::make('CLO_Description')
                                            ->label('Course Learning Outcome Description'),
                                    ])
                                    ->action(function (array $data, $record, \Livewire\Component $livewire) {
                                        $record->courseLearningOutcome()->create($data);
                                        $livewire->js('window.location.reload()');
                                    }),

                                Action::make('Edit Course Learning Outcome')
                                    ->label('Edit Course Learning Outcome')
                                    ->link()
                                    ->visible(fn ($record) => !empty($record->courseLearningOutcome))
                                     ->fillForm(fn ($record) => $record->courseLearningOutcome->toArray())
                                    ->schema([
                                        Textarea::make('CLO_Description')

                                            ->label('Course Learning Outcome Description'),
                                    ])
                                    ->action(function (array $data, $record, \Livewire\Component $livewire) {
                                        $record->courseLearningOutcome()->update($data);
                                        $livewire->js('window.location.reload()');
                                    })
                                    ->icon(Heroicon::Pencil),
                            ])
                            ->schema([
                                TextEntry::make('courseLearningOutcome.CLO_Description')
                                    ->label('CLO_Description')
                                    ->inlineLabel()
                                    ->visible(fn ($state) => !empty($state))
                            ])
            ])->columns(1);
    }
}
