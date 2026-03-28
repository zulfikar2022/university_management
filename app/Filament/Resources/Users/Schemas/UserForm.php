<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // --- 1. GENERAL USER INFORMATION ---
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->columnSpanFull()
                            ->label('Full Name'),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('username')
                            ->required()
                            ->default(fn () => 'user_' . substr(md5(uniqid()), 0, 8))
                            ->label('Username'),

                        TextInput::make('phone')
                            ->tel()
                            ->label('Phone Number'),

                        DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->native(false)
                            ->closeOnDateSelection(),

                        TextInput::make('nationality')
                            ->default('Bangladeshi'),

                        TextInput::make('nid_no')
                            ->label('NID Number')
                            ->columnSpanFull(),

                        Select::make('blood_group')
                            ->options([
                                'A+' => 'A+', 'A-' => 'A-',
                                'B+' => 'B+', 'B-' => 'B-',
                                'AB+' => 'AB+', 'AB-' => 'AB-',
                                'O+' => 'O+', 'O-' => 'O-',
                            ])
                            ->placeholder('Select Blood Group')
                            ->native(false),
                    ])
                    ->columns(2),

                // --- 2. SECURITY & ROLES ---
                Section::make()
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->visibleOn('create')
                            ->required(fn ($livewire) => $livewire instanceof \App\Filament\Resources\Users\Pages\CreateUser)
                            ->dehydrated(fn ($state) => filled($state))
                            ->label('Password'),

                        TextInput::make('confirm_password')
                            ->password()
                            ->revealable()
                            ->visibleOn('create')
                            ->required(fn ($livewire) => $livewire instanceof \App\Filament\Resources\Users\Pages\CreateUser)
                            ->dehydrated(false)
                            ->label('Confirm Password')
                            ->same('password'),

                        FileUpload::make('profile_image')
                            ->label('Profile Image')
                            ->image()
                            ->directory('profile-images')
                            ->disk('public')
                            ->columnSpanFull(),

                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable()
                            ->visibleOn('create')
                            ->required()
                            ->saveRelationshipsUsing(function ($record, $state) {
                                $record->syncRoles([$state]);
                            })
                            ->dehydrateStateUsing(fn ($state) => (array) $state)
                            ->label('Assign Role')
                            ->live()
                    ])
                    ->columns(1),

                // --- 3. CONDITIONAL: STUDENT INFORMATION ---
                Section::make('Student Information')
                    ->relationship('student')
                    ->visible(function (Get $get) {
                        $selectedRoles = (array) $get('roles');
                        return Role::whereIn('id', $selectedRoles)
                            ->where('name', 'Student')
                            ->exists();
                    })
                    ->schema([
                                        Select::make('faculty_id')
                                            ->label('Select Faculty')
                                            ->relationship('faculty', 'name')
                                            ->native(false)
                                            ->live()
                                            ->required()
                                            ->columnSpanFull(),

                                        Select::make('degree_id')
                                            ->label('Select Degree')
                                            ->required()
                                            ->disabled(fn (Get $get) => !$get('faculty_id'))
                                            ->relationship('degree', 'name', fn ($query, $get) => $query->where('faculty_id', $get('faculty_id')))
                                            ->native(false)
                                            ->columnSpanFull(),

                                        Select::make('hall_id')
                                            ->label('Select Hall')
                                            ->required()
                                            ->relationship('hall', 'name')
                                            ->native(false)
                                            ->columnSpanFull(),

                                        Select::make('level')
                                            ->required()
                                            ->options(['1' => 'One', '2' => 'Two', '3' => 'Three', '4' => 'Four', '5' => 'Five'])
                                            ->native(false),

                                        Select::make('semester')
                                            ->required()
                                            ->options(['I' => 'I', 'II' => 'II'])
                                            ->native(false),

                                        TextInput::make('SID')
                                            ->label('Student ID')
                                            ->required(),

                                        TextInput::make('session_year')
                                            ->numeric()
                                            ->required(),

                                        Select::make('residential_status')
                                            ->options(['Resident' => 'Resident', 'Non Resident' => 'Non Resident'])
                                            ->default('Non Resident')
                                            ->native(false),

                                        FileUpload::make('image')
                                            ->label('Profile Image')
                                            ->image()
                                            ->directory('student-images')
                                            ->disk('public')
                                            ->columnSpanFull(),
                                    ])->columns(2),

                // --- 4. CONDITIONAL: TEACHER INFORMATION ---
                Section::make('Teacher Information')
                    ->relationship('teacher')
                    ->visible(function (Get $get) {
                        $selectedRoles = (array) $get('roles');
                        return Role::whereIn('id', $selectedRoles)
                            ->where('name', 'Teacher')
                            ->exists();
                    })
                    ->schema([
                                        Select::make('faculty_id')
                                            ->live()
                                            ->label('Select Faculty')
                                            ->relationship('faculty', 'name')
                                            ->native(false)
                                            ->required()
                                            ->columnSpanFull(),

                                        Select::make('department_id')
                                            ->label('Select Department')
                                            ->relationship('department', 'name', fn ($query, $get) => $query->where('faculty_id', $get('faculty_id')))
                                            ->native(false)
                                            ->disabled(fn (Get $get) => !$get('faculty_id'))
                                            ->required()
                                            ->columnSpanFull(),

                                        Select::make('designation_id')
                                            ->label('Select Designation')
                                            ->relationship('designation', 'name')
                                            ->native(false)
                                            ->required()
                                            ->preload()
                                            ->searchable()
                                            ->columnSpanFull(),

                                        Textarea::make('career_obj')
                                            ->label('Career Objective')
                                            ->columnSpanFull()
                                    ])->columns(2),

                // --- 5. CONDITIONAL: HALL STAFF INFORMATION ---
                Section::make('Hall Staff Information')
                    ->relationship('hallStaff')
                    ->visible(function (Get $get) {
                        $selectedRoles = (array) $get('roles');
                        return Role::whereIn('id', $selectedRoles)
                            ->where('name', 'Hall Staff')
                            ->exists();
                    })
                    ->schema([
                                        Select::make('hall_id')
                                            ->label('Select Hall')
                                            ->relationship('hall', 'name')
                                            ->native(false)
                                            ->required()
                                            ->preload()
                                            ->searchable()
                                            ->columnSpanFull(),

                                         TextInput::make('designation')
                                            ->required()
                                            ->columnSpanFull(),
                                    ])->columns(2)
            ]);
    }
}
