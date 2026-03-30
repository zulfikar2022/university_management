<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class Halls extends Page
{
    protected string $view = 'filament.pages.halls';
    protected static string|UnitEnum|null $navigationGroup = 'Buildings & Halls';
    protected static ?int $navigationSort = 11;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice;
}
