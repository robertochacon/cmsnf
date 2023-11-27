<?php

namespace App\Filament\Resources\LicensesResource\Pages;

use App\Filament\Resources\LicensesResource;
use App\Models\Licenses;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLicenses extends ListRecords
{
    protected static string $resource = LicensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
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
                ->badge(Licenses::query()->count()),
            'Recibidas' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Recibida'))
                ->badge(Licenses::query()->where('status', 'Recibida')->count()),
            'Aprobadas' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Aprobada'))
                ->badge(Licenses::query()->where('status', 'Aprobada')->count()),
            'Rechazadas' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Rechazada'))
                ->badge(Licenses::query()->where('status', 'Rechazada')->count()),
        ];
    }

}
