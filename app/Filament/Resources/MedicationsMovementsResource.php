<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationsMovementsResource\Pages;
use App\Filament\Resources\MedicationsMovementsResource\RelationManagers;
use App\Models\MedicationsMovements;
use Filament\Forms;
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

    protected static ?string $modelLabel = 'Movimientos de medicamento';

    protected static ?string $pluralModelLabel = 'Movimientos de medicamentos';

    protected static ?string $navigationLabel = 'Movimientos de medicamentos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('quantity')
                ->label('Cantidad')
                ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quantity')
                ->label('Cantidad')
                ->default("N/A")
                ->numeric()
                ->sortable(),
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
