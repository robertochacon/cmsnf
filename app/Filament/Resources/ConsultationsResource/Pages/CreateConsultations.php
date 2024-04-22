<?php

namespace App\Filament\Resources\ConsultationsResource\Pages;

use App\Filament\Resources\ConsultationsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConsultations extends CreateRecord
{
    protected static string $resource = ConsultationsResource::class;

    protected static ?string $title = 'Crear Consulta';

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Crear nuevo paciente')
            ->url(fn (): string => '../patients/create')
        ];
    }
}
