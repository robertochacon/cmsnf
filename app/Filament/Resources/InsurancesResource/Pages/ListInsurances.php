<?php

namespace App\Filament\Resources\InsurancesResource\Pages;

use App\Filament\Resources\InsurancesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInsurances extends ListRecords
{
    protected static string $resource = InsurancesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
