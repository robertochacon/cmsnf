<?php

namespace App\Filament\Resources\PackagingsResource\Pages;

use App\Filament\Resources\PackagingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePackagings extends ManageRecords
{
    protected static string $resource = PackagingsResource::class;

    protected static ?string $title = 'Envaces';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
