<?php

namespace App\Filament\Resources\InsurancesResource\pages;

use App\Filament\Resources\InsurancesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInsurances extends ManageRecords
{
    protected static string $resource = InsurancesResource::class;

    protected static ?string $title = 'Seguros';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
