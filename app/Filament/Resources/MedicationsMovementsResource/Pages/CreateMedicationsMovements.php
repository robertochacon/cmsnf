<?php

namespace App\Filament\Resources\MedicationsMovementsResource\Pages;

use App\Filament\Resources\MedicationsMovementsResource;
use App\Models\Medications;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicationsMovements extends CreateRecord
{
    protected static string $resource = MedicationsMovementsResource::class;

    protected function afterCreate(): void
    {
        $medicationMovement = $this->record;

        $type = $medicationMovement->type;
        $quantity = $medicationMovement->quantity;
        $medicationIds = $medicationMovement->medication_ids; // IDs de los medicamentos seleccionados

        // Iterar sobre los medicamentos seleccionados
        foreach ($medicationIds as $medicationId) {
            $medication = Medications::find($medicationId);

            if ($medication) {
                if ($type === 'in') {
                    // Aumentar la cantidad
                    $medication->quantity += $quantity;
                } elseif ($type === 'out') {
                    // Disminuir la cantidad
                    $medication->quantity -= $quantity;

                    // Evitar valores negativos
                    if ($medication->quantity < 0) {
                        $medication->quantity = 0;
                    }
                }

                // Guardar cambios
                $medication->save();
            }
        }
    }
}
