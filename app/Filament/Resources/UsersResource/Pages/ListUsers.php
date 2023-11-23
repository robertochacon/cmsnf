<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UsersResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UsersResource::class;

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
                ->badge(User::query()->count()),
            'Super administradores' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'super'))
                ->badge(User::query()->where('type', 'super')->count()),
            'Administradores' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'admin'))
                ->badge(User::query()->where('type', 'admin')->count()),
            'Doctores' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'doctor'))
                ->badge(User::query()->where('type', 'doctor')->count()),
            'Administrativo' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'user'))
                ->badge(User::query()->where('type', 'user')->count()),
        ];
    }

}
