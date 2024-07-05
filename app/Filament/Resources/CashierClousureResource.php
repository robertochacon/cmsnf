<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashierClousureResource\Pages;
use App\Models\CashierClosure;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CashierClousureResource extends Resource
{
    protected static ?string $model = CashierClosure::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Pagos';

    protected static ?string $modelLabel = 'Cierre de caja';

    protected static ?string $pluralModelLabel = 'Cierres de caja';

    protected static ?string $navigationLabel = 'Cierres de caja';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información personal')
                    ->schema([
                    Forms\Components\TextInput::make('amount_start')
                        ->label('Monto Inicial')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('deposit')
                        ->label('Depósito')
                        ->numeric(),
                    Forms\Components\TextInput::make('output')
                        ->label('Salida')
                        ->numeric(),
                    Forms\Components\TextInput::make('cash_sale')
                        ->label('Venta en Efectivo')
                        ->numeric(),
                    Forms\Components\TextInput::make('credit_sale')
                        ->label('Venta a Crédito')
                        ->numeric(),
                    Forms\Components\TextInput::make('cash_purchase')
                        ->label('Compra en Efectivo')
                        ->numeric(),
                    Forms\Components\TextInput::make('buy_credit')
                        ->label('Compra a Crédito')
                        ->numeric(),
                    Forms\Components\TextInput::make('missing_balance')
                        ->label('Saldo Faltante')
                        ->numeric(),
                    Forms\Components\TextInput::make('remaining_balance')
                        ->label('Saldo Restante')
                        ->numeric(),
                    Forms\Components\TextInput::make('cash_balance')
                        ->label('Saldo en Efectivo')
                        ->numeric(),
                    Forms\Components\Select::make('status')
                        ->label('Estado')
                        ->options([
                            'Abierta' => 'Abierta',
                            'Cerrada' => 'Cerrada',
                        ])
                        ->default('Abierta'),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount_start')
                    ->label('Monto Inicial')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('deposit')
                    ->label('Depósito')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('output')
                    ->label('Salida')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('cash_sale')
                    ->label('Venta en Efectivo')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('credit_sale')
                    ->label('Venta a Crédito')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('cash_purchase')
                    ->label('Compra en Efectivo')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('buy_credit')
                    ->label('Compra a Crédito')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('missing_balance')
                    ->label('Saldo Faltante')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('remaining_balance')
                    ->label('Saldo Restante')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('cash_balance')
                    ->label('Saldo en Efectivo')
                    ->default('0.00'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListCashierClousures::route('/'),
            'create' => Pages\CreateCashierClousure::route('/create'),
            'edit' => Pages\EditCashierClousure::route('/{record}/edit'),
        ];
    }
}
