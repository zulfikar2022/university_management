<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Models\Department;
use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('department_id')
                            ->relationship('department', 'name')
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->required()
                            ->live(),

                        Select::make('degree_id')
                            ->relationship('degree', 'name', function (Get $get, Builder $query) {

                                $departmentId = $get('department_id');
                                if (! $departmentId) {
                                    return $query->whereNull('id');
                                }
                                $facultyId = Department::find($departmentId)?->faculty_id;

                                return $query->where('faculty_id', $facultyId);
                            })
                            ->native(false)
                            ->preload()
                            ->required()
                            ->searchable()
                            ->disabled(fn (Get $get) => empty($get('department_id'))),
                                Group::make()
                                    ->schema([
                                        Select::make('level')
                                    ->native(false)
                                    ->required()
                                    ->options([
                                        '1' => 'One',
                                        '2' => 'Two',
                                        '3' => 'Three',
                                        '4' => 'Four',
                                        '5' => 'Five'
                                    ]),
                                Select::make('semester')
                                    ->native(false)
                                    ->required()
                                    ->options([
                                        'I' => 'I',
                                        'II' => 'II'
                                ])
                            ])->columns(2)
                    ]),
                Section::make('Course Details')
                    ->schema([
                        TextInput::make('courseTitle')
                            ->required(),
                        Group::make()
                            ->schema([
                                TextInput::make('courseCode')
                                    ->required(),
                                TextInput::make('credit')
                                    ->required()
                                    ->numeric()
                            ])->columns(2),
                        Group::make()
                            ->schema([
                                TextInput::make('contactHourPerWeek')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('academicSession')
                                    ->required()
                            ])
                            ->columns(2),
                        Group::make()
                            ->schema([
                                TextInput::make('type')
                                    ->required(),
                                TextInput::make('type_T_S')
                                    ->required()
                                    ->label('type_T_S')
                            ])->columns(2)
                    ]),

                Section::make()
                    ->schema([
                        Group::make()
                            ->schema([
                                TextInput::make('instructor'),
                                TextInput::make('totalMarks')
                                    ->numeric(),
                            ])->columns(2),
                        Textarea::make('prerequisite'),
                        TextArea::make('summary'),

                    ])->columnSpanFull()

            ])->columns(2);
    }
}
