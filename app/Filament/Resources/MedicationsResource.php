<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationsResource\Pages;
use App\Filament\Resources\MedicationsResource\RelationManagers;
use App\Models\Medications;
use App\Models\Packagings;
use App\Models\Suppliers;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class MedicationsResource extends Resource
{
    protected static ?string $model = Medications::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Farmacia';

    protected static ?string $navigationLabel = 'Farmacia';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Descripción')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('manufacturer')
                        ->label('Fabricante'),
                    Forms\Components\TextInput::make('dosage')
                        ->label('Dosificación'),
                    Forms\Components\TextInput::make('price')
                        ->label('Precio')
                        ->numeric()
                        ->prefix('$'),
                    Forms\Components\TextInput::make('quantity')
                        ->label('Cantidad')
                        ->numeric(),
                    Forms\Components\DatePicker::make('expiry_date')
                        ->label('Fecha de caducidad'),
                    Forms\Components\Toggle::make('prescription_required')
                        ->label('Requiere receta')
                        ->required(),
                    Forms\Components\TextInput::make('active_substance')
                        ->label('Sustancia activa'),
                    Forms\Components\Textarea::make('storage_conditions')
                        ->label('Condiciones de almacenamiento')
                        ->columnSpanFull(),
                        Forms\Components\Select::make('status')
                        ->label('Estado')
                        ->options([
                            'inbound' => 'Entrada',
                            'outgoing' => 'Salida',
                        ])
                        ->nullable(),
                    Forms\Components\Select::make('supplier_id')
                        ->options(Suppliers::all()->pluck('name', 'id'))
                        ->label('Suplidor')
                        ->searchable(),
                    Forms\Components\Select::make('packaging_id')
                        ->options(Packagings::all()->pluck('name', 'id'))
                        ->label('Envace')
                        ->searchable(),
                ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('manufacturer')
                    ->label('Fabricante')
                    ->default("N/A")
                    ->searchable(),
                Tables\Columns\TextColumn::make('dosage')
                    ->label('Dosificación')
                    ->default("N/A")
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->default("N/A")
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->default("N/A")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->label('Fecha de caducidad')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('prescription_required')
                    ->label('Requiere receta')
                    ->boolean(),
                Tables\Columns\TextColumn::make('active_substance')
                    ->label('Sustancia activa')
                    ->default("N/A")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Estado')
                    ->options([
                        'inbound' => 'Entrada',
                        'outgoing' => 'Salida',
                    ])
                    ->selectablePlaceholder(false),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->default("N/A")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->default("N/A")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Imprimir')
                ->icon('heroicon-o-arrow-down-on-square-stack')
                ->url(fn(Medications $record) => route('licenses.pdf.download', $record))
                ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMedications::route('/'),
        ];
    }
}
