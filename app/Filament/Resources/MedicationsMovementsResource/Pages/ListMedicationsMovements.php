<?php

namespace App\Filament\Resources\MedicationsMovementsResource\Pages;

use App\Filament\Resources\MedicationsMovementsResource;
use App\Models\MedicationsMovements;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMedicationsMovements extends ListRecords
{
    protected static string $resource = MedicationsMovementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make()
                ->badge(MedicationsMovements::query()->count()),
            'Entrada' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'in'))
                ->badge(MedicationsMovements::query()->where('type', 'in')->count()),
            'Salida' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'out'))
                ->badge(MedicationsMovements::query()->where('type', 'out')->count()),
        ];
    }
}
