<?php

namespace App\Filament\Widgets;

use App\Models\Patients;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PatientsChart extends ChartWidget
{
    protected static ?string $heading = 'Pacientes';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = Trend::model(Patients::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Pacientes',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
