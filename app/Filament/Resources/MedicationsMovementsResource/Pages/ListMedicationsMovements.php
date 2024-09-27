<?php

namespace App\Filament\Resources\MedicationsMovementsResource\Pages;

use App\Filament\Resources\MedicationsMovementsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicationsMovements extends ListRecords
{
    protected static string $resource = MedicationsMovementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
