<?php

namespace App\Filament\Resources\EmergenciesResource\Pages;

use App\Filament\Resources\EmergenciesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmergencies extends ListRecords
{
    protected static string $resource = EmergenciesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
