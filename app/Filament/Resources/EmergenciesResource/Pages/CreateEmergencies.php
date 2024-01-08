<?php

namespace App\Filament\Resources\EmergenciesResource\Pages;

use App\Filament\Resources\EmergenciesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmergencies extends CreateRecord
{
    protected static string $resource = EmergenciesResource::class;

    protected static ?string $title = 'Crear Emergencia';

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
}
