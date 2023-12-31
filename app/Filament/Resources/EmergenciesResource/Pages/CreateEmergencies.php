<?php

namespace App\Filament\Resources\EmergenciesResource\Pages;

use App\Filament\Resources\EmergenciesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmergencies extends CreateRecord
{
    protected static string $resource = EmergenciesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
