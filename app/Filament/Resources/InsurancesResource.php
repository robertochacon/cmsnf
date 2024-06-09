<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InsurancesResource\Pages;
use App\Models\Insurances;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InsurancesResource extends Resource
{
    protected static ?string $model = Insurances::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Matenimiento';

    protected static ?string $navigationLabel = 'Seguros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required()->label('Nombre'),
                TextInput::make('phone')->label('Teléfono'),
                TextInput::make('coverage')->prefix('%')->numeric()->minValue(0)->maxValue(100)->label('Covertura'),
                Toggle::make('status')->label('Estado')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->label('Nombre')
                ->searchable(),
                TextColumn::make('phone')->default('N/A')->label('Teléfono'),
                TextColumn::make('coverage')->prefix('%')->label('Covertura'),
                TextColumn::make('created_at')->since()->label('creado'),
                ToggleColumn::make('status')->label('Estado')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar')
                ->modalHeading('Editar registro'),
                Tables\Actions\DeleteAction::make()->label('Eliminar')
                ->modalHeading('¿Realmente quieres eliminar este registro?'),
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
            'index' => Pages\ManageInsurances::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isSuper() || auth()->user()->isAdmin();
    }

}
