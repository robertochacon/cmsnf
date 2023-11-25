<?php

namespace App\Filament\Resources\PatientsResource\Pages;

use App\Filament\Resources\PatientsResource;
use App\Models\Patients;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientsResource::class;

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
                ->badge(Patients::query()->count()),
            'Militares' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('range'))
                ->badge(Patients::query()->whereNotNull('range')->count()),
            'Civiles' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('range',null))
                ->badge(Patients::query()->where('range',null)->count()),
        ];
    }
}
