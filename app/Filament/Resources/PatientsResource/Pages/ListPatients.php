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

    protected static ?string $title = 'Pacientes';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nuevo Paciente')
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_id'] = auth()->id();
                return $data;
            }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make()
                ->badge(Patients::query()->count()),
            'Militares' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('military', true))
                ->badge(Patients::query()->where('military', true)->count()),
            'Civiles' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('military', false))
                ->badge(Patients::query()->where('military',false)->count()),
        ];
    }
}
