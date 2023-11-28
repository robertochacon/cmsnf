<?php

namespace App\Filament\Resources\EmergenciesResource\Pages;

use App\Filament\Resources\EmergenciesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmergencies extends EditRecord
{
    protected static string $resource = EmergenciesResource::class;

    protected static ?string $title = 'Editar Emergencia';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Eliminar'),
        ];
    }
}
