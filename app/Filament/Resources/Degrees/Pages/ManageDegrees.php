<?php

namespace App\Filament\Resources\Degrees\Pages;

use App\Filament\Resources\Degrees\DegreeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Icons\Heroicon;

class ManageDegrees extends ManageRecords
{
    protected static string $resource = DegreeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Add Degree')
                ->icon(Heroicon::Plus),
        ];
    }
}
