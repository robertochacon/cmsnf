<?php

namespace App\Filament\Resources\MedicationsResource\Pages;

use App\Filament\Resources\MedicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMedications extends ManageRecords
{
    protected static string $resource = MedicationsResource::class;

    protected static ?string $title = 'Entrada y Salida de Medicamentos';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->createAnother(false)->label('Nuevo registro')
            ->modalHeading('Nuevo registro'),
        ];
    }
}
