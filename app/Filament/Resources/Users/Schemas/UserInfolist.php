<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                ->headerActions([
                    EditAction::make()
                        ->icon('heroicon-o-pencil')
                        ->link(),
                ], )
                ->schema([
                    ImageEntry::make('profile_image')
                        ->disk('public')
                        ->imageWidth(200)
                        ->imageHeight(200)
                        ->defaultImageUrl(asset('images/user.png')),
                    Group::make()->schema([
                        TextEntry::make('name')->inlineLabel(),

                        TextEntry::make('email')->inlineLabel(),

                        TextEntry::make('roles.0.name')
                            ->label('Role')
                            ->badge()
                            ->inlineLabel(),

                        TextEntry::make('phone')
                            ->label('Phone Number')
                            ->inlineLabel()
                            ->visible(fn ($state) => Str::length($state)),

                        TextEntry::make('dob')
                            ->label('Date of Birth')
                            ->inlineLabel()
                            ->date()
                            ->visible(fn ($state) => Str::length($state)),

                        TextEntry::make('nationality')
                            ->label('Nationality')
                            ->inlineLabel()
                            ->visible(fn ($state) => Str::length($state)),

                        TextEntry::make('nid_no')
                            ->label('National ID Number')
                            ->inlineLabel()
                            ->visible(fn ($state) => Str::length($state)),

                        TextEntry::make('blood_group')
                            ->label('Blood Group')
                            ->inlineLabel()
                            ->visible(fn ($state) => Str::length($state)),
                ]),
            ])->columns(2),

            Section::make('User Details')
                ->headerActions([
                    Action::make('add_address')
                        ->label('Add Address')
                        ->icon('heroicon-o-plus')
                        ->visible(fn ($record) => !$record->address)
                        ->link()
                        ->schema([
                            Group::make()->schema([
                                // Note: Removed 'address.' prefix for easier saving
                                // Also fixed a small typo: 'divison' -> 'division' (match your DB!)
                                TextInput::make('present_division')->label('Present Division')->required(),
                                TextInput::make('present_district')->label('Present District')->required(),
                                TextInput::make('present_upazila')->label('Present Upazila')->required(),
                                TextInput::make('present_area')->label('Present Area')->required(),

                                TextInput::make('permanent_division')->label('Permanent Division')->required(),
                                TextInput::make('permanent_district')->label('Permanent District')->required(),
                                TextInput::make('permanent_upazila')->label('Permanent Upazila')->required(),
                                TextInput::make('permanent_area')->label('Permanent Area')->required(),

                                TextInput::make('permanent_district_distance')
                                    ->suffix('km')
                                    ->label('Distance from University (Approximate)')
                                    ->numeric(),
                            ])->columns(2)
                        ])
                        ->action(function (array $data, $record, \Livewire\Component $livewire) {
                            $record->address()->create($data);

                            // make a forcefull refresh of the page to show the updated address info

                            $livewire->js('window.location.reload()');
                        }),

                    Action::make('edit_address')
                    ->label('Edit Address')
                    ->icon('heroicon-o-pencil')
                    ->visible(fn ($record) => $record->address)
                    ->link()
                    // THIS pre-fills the modal with the existing address data
                    ->fillForm(fn ($record) => $record->address->toArray())
                    ->schema([
                        Group::make()->schema([
                            // Reuse the exact same inputs here
                            TextInput::make('present_division')->label('Present Division')->required(),
                            TextInput::make('present_district')->label('Present District')->required(),
                            TextInput::make('present_upazila')->label('Present Upazila')->required(),
                            TextInput::make('present_area')->label('Present Area')->required(),

                            TextInput::make('permanent_division')->label('Permanent Division')->required(),
                            TextInput::make('permanent_district')->label('Permanent District')->required(),
                            TextInput::make('permanent_upazila')->label('Permanent Upazila')->required(),
                            TextInput::make('permanent_area')->label('Permanent Area')->required(),

                            TextInput::make('permanent_district_distance')
                                ->suffix('km')
                                ->label('Distance from University (Approximate)')
                                ->numeric(),
                        ])->columns(2)
                    ])
                    // THIS updates the existing data!
                    ->action(function (array $data, $record, \Livewire\Component $livewire) {
                        $record->address()->update($data);

                        $livewire->js('window.location.reload()');
                    }),
                ])
                // ->visible(fn ($record) => $record->roles->pluck('name')->contains('Student'))
                ->schema([
                    Group::make()
                        ->visible(fn ($record) => $record->roles->pluck('name')->contains('Student'))
                        ->schema([
                            TextEntry::make('student.faculty.name')
                                ->label('Faculty')
                                ->inlineLabel(),

                            TextEntry::make('student.degree.name')
                                ->label('Degree')
                                ->inlineLabel(),

                            TextEntry::make('student.hall.name')
                                ->label('Hall')
                                ->inlineLabel(),
                            TextEntry::make('student.SID')
                                ->label('Student ID')
                                ->inlineLabel(),

                            Group::make()->schema([
                                TextEntry::make('student.level')
                                ->label('Level')
                                ->inlineLabel(),

                                TextEntry::make('student.semester')
                                    ->label('Semester')
                                    ->inlineLabel(),
                            ])->columns(1),

                            TextEntry::make('student.session_year')
                                    ->label('Session Year')
                                    ->inlineLabel(),

                            TextEntry::make('student.residential_status')
                                    ->label('Residential Status')
                                    ->inlineLabel(),
                     ]),

                    Group::make()
                        ->visible(fn ($record) => $record->roles->pluck('name')->contains('Teacher'))
                        ->schema([
                            TextEntry::make('teacher.faculty.name')
                                ->label('Faculty')
                                ->inlineLabel(),
                            TextEntry::make('teacher.department.name')
                                ->label('Department')
                                ->inlineLabel(),
                            TextEntry::make('teacher.designation.name')
                                ->label('Designation')
                                ->inlineLabel(),

                            TextEntry::make('teacher.career_obj')
                                ->label('Career Objective')
                                ->inlineLabel()
                                ->visible(fn ($state) => Str::length($state) > 0)
                                ->columnSpanFull(),
                    ]),

                    Group::make()
                        ->visible(fn ($record) => $record->roles->pluck('name')->contains('Hall Staff'))
                        ->schema([
                            TextEntry::make('hallStaff.hall.name')
                                ->label('Hall')
                                ->inlineLabel(),
                            TextEntry::make('hallStaff.designation')
                                ->label('Designation')
                                ->inlineLabel(),
                    ]),


                    Group::make()
                        ->visible(fn ($record) => $record->address)
                        ->schema([
                            TextEntry::make('address.present_division')
                                ->label('Present Division')
                                ->inlineLabel(),
                            TextEntry::make('address.present_district')
                                ->label('Present District')
                                ->inlineLabel(),
                            TextEntry::make('address.present_upazila')
                                ->label('Present Upazila')
                                ->inlineLabel(),
                            TextEntry::make('address.present_area')
                                ->label('Present Area')
                                ->inlineLabel(),

                            TextEntry::make('address.permanent_division')
                                ->label('Permanent Division')
                                ->inlineLabel(),
                            TextEntry::make('address.permanent_district')
                                ->label('Permanent District')
                                ->inlineLabel(),
                            TextEntry::make('address.permanent_upazila')
                                ->label('Permanent Upazila')
                                ->inlineLabel(),
                            TextEntry::make('address.permanent_area')
                                ->label('Permanent Area')
                                ->inlineLabel(),
                            TextEntry::make('address.permanent_district_distance')
                                ->suffix(' km')
                                ->label('Distance from University (Approximate)')
                                ->visible(fn ($state) => !empty($state))
                                ->inlineLabel()

                        ])

                ])->columns(2),
            Section::make('Guardian Details')
                ->visible(fn ($record) => $record->roles->pluck('name')->contains('Student'))
                ->headerActions([
                    Action::make('add_guardian')
                        ->label('Add Guardian')
                        ->icon('heroicon-o-plus')
                        ->visible(fn ($record) => $record->student && !$record->student->guardian)
                        ->link()
                        ->schema([
                            Group::make()->schema([
                                // Note: Removed 'guardian.' prefix for easier saving
                                // father_name, father_phone, mother_name, mother_phone, father_nid, mother_nid, guardian_occupation, income_per_year (all are nullable)

                                TextInput::make('father_name')->label('Father\'s Name')->required(),
                                TextInput::make('father_phone')->label('Father\'s Phone Number'),
                                TextInput::make('mother_name')->label('Mother\'s Name')->required(),
                                TextInput::make('mother_phone')->label('Mother\'s Phone Number'),
                                TextInput::make('father_nid')->label('Father\'s National ID Number'),
                                TextInput::make('mother_nid')->label('Mother\'s National ID Number'),
                                TextInput::make('guardian_occupation')->label('Guardian\'s Occupation'),
                                TextInput::make('income_per_year')->prefix('BDT')
                                    ->label('Income Per Year')
                            ])->columns(2)
                        ])
                        ->action(function (array $data, $record, \Livewire\Component $livewire) {
                            $record->student->guardian()->create($data);
                            $livewire->js('window.location.reload()');
                        }),

                    Action::make('edit_guardian')
                        ->label('Edit Guardian')
                        ->icon('heroicon-o-pencil')
                        ->visible(fn ($record) => $record->student && $record->student->guardian)
                        ->link()
                        ->fillForm(fn ($record) => $record->student->guardian->toArray())
                        ->schema([
                            // Reuse the exact same inputs here
                            Group::make()->schema([
                                TextInput::make('father_name')->label('Father\'s Name')->required(),
                                TextInput::make('father_phone')->label('Father\'s Phone Number'),
                                TextInput::make('mother_name')->label('Mother\'s Name')->required(),
                                TextInput::make('mother_phone')->label('Mother\'s Phone Number'),
                                TextInput::make('father_nid')->label('Father\'s National ID Number'),
                                TextInput::make('mother_nid')->label('Mother\'s National ID Number'),
                                TextInput::make('guardian_occupation')->label('Guardian\'s Occupation'),
                                TextInput::make('income_per_year')->prefix('BDT')
                                    ->label('Income Per Year')
                            ])->columns(2)
                        ])
                        ->action(function (array $data, $record, \Livewire\Component $livewire) {
                            $record->student->guardian()->update($data);
                            $livewire->js('window.location.reload()');
                        }),
                ])
                ->schema([
                    Group::make()
                        ->schema([

                        Group::make()
                            ->schema([
                                TextEntry::make('student.guardian.father_name')
                                    ->label('Father\'s Name')
                                    ->inlineLabel(),
                                TextEntry::make('student.guardian.father_phone')
                                    ->label('Father\'s Contact')
                                    ->inlineLabel()
                                    ->visible(fn ($state) => Str::length($state) > 0),
                                TextEntry::make('student.guardian.father_nid')
                                    ->label('Father\'s NID')
                                    ->inlineLabel()
                                    ->visible(fn ($state) => Str::length($state) > 0),
                            ]),

                        Group::make()
                            ->schema([
                                TextEntry::make('student.guardian.mother_name')
                                    ->label('Mother\'s Name')
                                    ->inlineLabel(),
                                TextEntry::make('student.guardian.mother_phone')
                                    ->label('Mother\'s Contact')
                                    ->inlineLabel()
                                    ->visible(fn ($state) => Str::length($state) > 0),
                                TextEntry::make('student.guardian.mother_nid')
                                    ->label('Mother\'s NID')
                                    ->inlineLabel()
                                    ->visible(fn ($state) => Str::length($state) > 0),
                            ]),

                            TextEntry::make('student.guardian.guardian_occupation')
                                ->label('Guardian\'s Occupation')
                                ->inlineLabel()
                                ->visible(fn ($state) => Str::length($state) > 0),

                            TextEntry::make('student.guardian.income_per_year')
                                ->money('BDT')
                                ->label('Income Per Year')
                                ->inlineLabel()
                                ->visible(fn ($state) => Str::length($state) > 0),
                        ])
                        ->columns(2)
                ])

        ])
        ->columns(1);
    }
}
