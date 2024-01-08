<?php

namespace App\Filament\Resources\ProfessionsResource\pages;

use App\Filament\Resources\ProfessionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProfessions extends ManageRecords
{
    protected static string $resource = ProfessionsResource::class;

    protected static ?string $title = 'Profesiónes';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->createAnother(false)->label('Nueva Profesión'),
        ];
    }
}
