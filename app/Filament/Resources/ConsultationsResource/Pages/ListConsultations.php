<?php

namespace App\Filament\Resources\ConsultationsResource\Pages;

use App\Filament\Resources\ConsultationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsultations extends ListRecords
{
    protected static string $resource = ConsultationsResource::class;

    protected static ?string $title = 'Consultas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
        ];
    }
}
