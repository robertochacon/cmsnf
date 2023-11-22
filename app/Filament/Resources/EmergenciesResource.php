<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmergenciesResource\Pages;
use App\Filament\Resources\EmergenciesResource\RelationManagers;
use App\Models\Emergencies;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmergenciesResource extends Resource
{
    protected static ?string $model = Emergencies::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListEmergencies::route('/'),
            'create' => Pages\CreateEmergencies::route('/create'),
            'edit' => Pages\EditEmergencies::route('/{record}/edit'),
        ];
    }
}
