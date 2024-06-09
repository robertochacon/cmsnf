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
            Actions\Action::make('Crear Emergencia')
            ->url(fn (): string => url('admin/emergencies/create')),
            Actions\Action::make('Generar reporte')
            ->color('warning')
            ->url(fn (): string => url($this->getRecord()->id.'/patient')),
            Actions\DeleteAction::make()->label('Eliminar')
            ->visible(fn ($record) => $record->can_edit),
        ];
    }
}
