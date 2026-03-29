<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
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
                Section::make()->schema([
                    ImageEntry::make('profile_image')
                        ->disk('public')
                        // ->circular()
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

            Section::make('Student Details')
                ->headerActions([
                    Action::make('Add Address')
                            ->icon('heroicon-o-plus')
                            ->visible(fn ($record) => !$record->address)
                            ->link(),

                    Action::make('Edit Address')
                            ->icon('heroicon-o-pencil')
                            ->visible(fn ($record) => $record->address)
                            ->link(),
                ])
                ->visible(fn ($record) => $record->roles->pluck('name')->contains('Student'))
                ->schema([
                    Group::make()->schema([
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
                     ])

                ])->columns(2),


        ])->columns(1);
    }
}
