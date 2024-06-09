<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstitutionsResource\Pages;
use App\Models\Institutions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InstitutionsResource extends Resource
{
    protected static ?string $model = Institutions::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Matenimiento';

    protected static ?string $navigationLabel = 'Instituciónes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required()->label('Nombre'),
                TextInput::make('siglas')->required()->label('Siglas'),
                TextInput::make('phone')->label('Teléfono'),
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
                TextColumn::make('siglas')->label('Siglas')
                ->searchable(),
                // TextColumn::make('phone')->default('N/A'),
                // TextColumn::make('created_at')->since(),
                ToggleColumn::make('status')->label('Creado')
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
            'index' => Pages\ManageInstitutions::route('/'),
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
