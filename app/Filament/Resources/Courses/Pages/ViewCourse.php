<?php

namespace App\Filament\Resources\Courses\Pages;

use App\Filament\Resources\Courses\CourseResource;
use App\Filament\Resources\Courses\RelationManagers\CourseContentsRelationManager;
use App\Filament\Resources\Courses\RelationManagers\ReferenceBooksRelationManager;
use App\Filament\Resources\Courses\RelationManagers\WeeklyLessonPlansRelationManager;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit Course')
                ->link()
                ->icon(Heroicon::Pencil)
                ->url($this->getResource()::getUrl('edit', ['record' => $this->record])),
        ];
    }

    public function getRelationManagers(): array
    {
        // We merge with the parent so we don't accidentally hide the Reference Books!
        return array_merge(parent::getRelationManagers(), [
            ReferenceBooksRelationManager::class,
            CourseContentsRelationManager::class,
            WeeklyLessonPlansRelationManager::class,
        ]);
    }
}
