<?php

namespace App\Filament\Resources\SpecialtiesResource\pages;

use App\Filament\Resources\SpecialtiesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSpecialties extends ManageRecords
{
    protected static string $resource = SpecialtiesResource::class;

    protected static ?string $title = 'Especialidades medicinal';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nueva Especialidad'),
        ];
    }
}
