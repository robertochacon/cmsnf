<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentsResource\Pages;
use App\Models\Insurances;
use App\Models\Payments;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PaymentsResource extends Resource
{
    protected static ?string $model = Payments::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Pagos';

    protected static ?string $navigationLabel = 'Pagos';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('identification')->numeric()->required()->label('Identificación'),
                TextInput::make('name')->required()->label('Nombre'),
                RichEditor::make('description')->label('Descripción')
                    ->columnSpan('full'),
                    Select::make('to')->label('Pago de consulta/emergencia')
                    ->options([
                        'Consulta' => 'Consulta',
                        'Emergencia' => 'Emergencia',
                    ])
                    ->searchable(),
                Select::make('insurance_id')->label('Seguro')
                    ->options(Insurances::all()->pluck('name','id'))
                    ->searchable(['name'])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set){
                        $coverage = Insurances::where('id', $state)->first()->coverage;
                        $set('coverage', $coverage);
                    }),
                TextInput::make('nss')->label('NSS')
                    ->numeric(),
                TextInput::make('coverage')->label('Covertura')
                    ->prefix('$')
                    ->numeric()
                    ->readOnly(),
                TextInput::make('cost')->label('Costo')
                    ->prefix('$')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, Get $get){
                        $result = $state - ($state * $get('coverage') / 100);
                        $set('total', $result);
                    }),
                TextInput::make('total')->label('Total a pagar')
                    ->prefix('$')
                    ->numeric()
                    ->required(),
                Select::make('type')->label('Forma de pago')
                    ->options([
                        'Efectivo' => 'Efectivo',
                        'Tarjeta' => 'Tarjeta',
                    ])
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('identification')->label('Identification')
                ->searchable(),
                TextColumn::make('name')->label('Nombre')
                ->searchable(),
                TextColumn::make('to')->label('Tipo de pago'),
                TextColumn::make('coverage')->prefix('%')->label('Covertura'),
                TextColumn::make('cost')->money()->label('Costo'),
                TextColumn::make('total')->money()->label('Total'),
                TextColumn::make('created_at')->since()->label('Creado'),
                TextColumn::make('type')->label('Forma de pago'),
            ])
            ->filters([
                SelectFilter::make('to')
                ->label('Tipo de pago')
                ->options([
                    'Consulta' => 'Consulta',
                    'Emergencia' => 'Emergencia',
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePayments::route('/'),
        ];
    }
}
