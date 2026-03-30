<?php

namespace App\Filament\Resources\Faculties\Pages;

use App\Filament\Resources\Faculties\FacultyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Icons\Heroicon;

class ManageFaculties extends ManageRecords
{
    protected static string $resource = FacultyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add Faculty')
                ->icon(Heroicon::Plus)
                ->createAnother(false),
        ];
    }
}
