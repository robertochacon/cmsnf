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
                TextInput::make('identification')->numeric()->required(),
                TextInput::make('name')->required(),
                RichEditor::make('description')
                    ->columnSpan('full'),
                Select::make('insurance_id')
                    ->options(Insurances::all()->pluck('name','id'))
                    ->searchable(['name'])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set){
                        $coverage = Insurances::where('id', $state)->first()->coverage;
                        $set('coverage', $coverage);
                    }),
                TextInput::make('coverage')
                    ->prefix('$')
                    ->numeric()
                    ->required()
                    ->readOnly(),
                TextInput::make('cost')
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
                Select::make('status')->label('Pay')
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
                TextColumn::make('identification')
                ->searchable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('coverage')->prefix('%'),
                TextColumn::make('cost')->money(),
                TextColumn::make('total')->money(),
                TextColumn::make('created_at')->since(),
                TextColumn::make('status')->label('Method'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
