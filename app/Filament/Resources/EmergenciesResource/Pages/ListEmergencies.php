<?php

namespace App\Filament\Resources\EmergenciesResource\Pages;

use App\Filament\Resources\EmergenciesResource;
use App\Models\Emergencies;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEmergencies extends ListRecords
{
    protected static string $resource = EmergenciesResource::class;

    protected static ?string $title = 'Emergencias';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
        ];
    }

    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make()
                ->badge(Emergencies::query()->count()),
            'Atendiendo' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Atendiendo'))
                ->badge(Emergencies::query()->where('status', 'Atendiendo')->count()),
            'Atendidas' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Atendida'))
                ->badge(Emergencies::query()->where('status', 'Atendida')->count()),
            'Traslado' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Traslado'))
                ->badge(Emergencies::query()->where('status', 'Traslado')->count()),
        ];
    }
}
