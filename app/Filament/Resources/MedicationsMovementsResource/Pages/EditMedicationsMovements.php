<?php

namespace App\Filament\Resources\MedicationsMovementsResource\Pages;

use App\Filament\Resources\MedicationsMovementsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicationsMovements extends EditRecord
{
    protected static string $resource = MedicationsMovementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
