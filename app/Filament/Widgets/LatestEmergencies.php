<?php

namespace App\Filament\Widgets;

use App\Models\Emergencies;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestEmergencies extends BaseWidget
{

    protected static ?string $heading = 'Ultimas emergencias';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(Emergencies::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('user.name'),
                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Atendiendo' => 'info',
                    'Atendida' => 'success',
                    'Traslado' => 'warning',
                }),
                TextColumn::make('created_at')->since()
            ]);
    }
}
