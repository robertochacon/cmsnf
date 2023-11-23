<?php

namespace App\Filament\Resources\InstitutionsResource\Pages;

use App\Filament\Resources\InstitutionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstitutions extends ListRecords
{
    protected static string $resource = InstitutionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
