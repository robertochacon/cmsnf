<?php

namespace App\Filament\Resources\PatientsResource\Pages;

use App\Filament\Resources\PatientsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatients extends EditRecord
{
    protected static string $resource = PatientsResource::class;

    protected static ?string $title = 'Editar Paciente';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Eliminar'),
        ];
    }
}
