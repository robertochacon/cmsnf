<?php

namespace App\Filament\Resources\ConsultationsResource\Pages;

use App\Filament\Resources\ConsultationsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsultations extends EditRecord
{
    protected static string $resource = ConsultationsResource::class;

    protected static ?string $title = 'Editar Consulta';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
