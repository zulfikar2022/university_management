<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    ImageEntry::make('profile_image')
                        ->disk('public')
                        ->circular()
                        ->defaultImageUrl(asset('images/user.png')),
                    Section::make()->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        // TextEntry::make('blood_group')->label('Blood Group'),
                        // role
                        TextEntry::make('roles.0.name')->label('Role'),
                ]),
            ])->columns(2),
        ])->columns(1);
    }
}
