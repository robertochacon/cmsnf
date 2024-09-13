<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class Filters extends Widget
{
    protected static string $view = 'filament.widgets.filters';

    public function form_filter(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Grid::make()
                    ->schema([
                        DatePicker::make('from')
                            ->live()
                            ->afterStateUpdated(fn (?string $state) => $this->dispatch('updateFromDate', from: $state)),
                        DatePicker::make('to')
                            ->live()
                            ->afterStateUpdated(fn (?string $state) => $this->dispatch('updateToDate', to: $state)),
                    ]),
            ]);
    }

    public static function canView(): bool
    {
        return false;
    }

}
