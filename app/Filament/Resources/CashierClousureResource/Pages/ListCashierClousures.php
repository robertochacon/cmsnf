<?php

namespace App\Filament\Resources\CashierClousureResource\Pages;

use App\Filament\Resources\CashierClousureResource;
use App\Models\CashierClosure;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListCashierClousures extends ListRecords
{
    protected static string $resource = CashierClousureResource::class;

    protected static ?string $title = 'Cierre de caja';

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
                ->badge(CashierClosure::query()->count()),
            'Abierta' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Abierta'))
                ->badge(CashierClosure::query()->where('status', 'Abierta')->count()),
            'Cerrada' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Cerrada'))
                ->badge(CashierClosure::query()->where('status', 'Cerrada')->count()),
        ];
    }

}
