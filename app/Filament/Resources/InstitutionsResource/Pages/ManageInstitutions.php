<?php

namespace App\Filament\Resources\InstitutionsResource\pages;

use App\Filament\Resources\InstitutionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInstitutions extends ManageRecords
{
    protected static string $resource = InstitutionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
