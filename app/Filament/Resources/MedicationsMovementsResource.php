<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationsMovementsResource\Pages;
use App\Filament\Resources\MedicationsMovementsResource\RelationManagers;
use App\Models\Medications;
use App\Models\MedicationsMovements;
use App\Models\Patients;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicationsMovementsResource extends Resource
{
    protected static ?string $model = MedicationsMovements::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Farmacia';

    protected static ?string $modelLabel = 'Movimiento';

    protected static ?string $pluralModelLabel = 'Movimientos';

    protected static ?string $navigationLabel = 'Movimientos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información General')
                ->schema([
                    Forms\Components\Select::make('medication_id')
                        ->label('Medicamento')
                        ->options(Medications::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\Select::make('patient_id')
                        ->label('Paciente')
                        ->options(Patients::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TextInput::make('quantity')
                        ->label('Cantidad')
                        ->numeric(),
                    Forms\Components\TextInput::make('type')
                        ->label('Tipo de Movimiento'),
                    Forms\Components\Textarea::make('note')
                        ->label('Nota')
                        ->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('medication_id')
                    ->label('ID del Medicamento')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient_id')
                    ->label('ID del Paciente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo de Movimiento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListMedicationsMovements::route('/'),
            'create' => Pages\CreateMedicationsMovements::route('/create'),
            'edit' => Pages\EditMedicationsMovements::route('/{record}/edit'),
        ];
    }
}
