<?php

namespace App\Filament\Resources\CashierClousureResource\Pages;

use App\Filament\Resources\CashierClousureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCashierClousure extends EditRecord
{
    protected static string $resource = CashierClousureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
