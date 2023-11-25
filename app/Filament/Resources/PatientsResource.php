<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientsResource\Pages;
use App\Filament\Resources\PatientsResource\RelationManagers;
use App\Models\Patients;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PatientsResource extends Resource
{
    protected static ?string $model = Patients::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Patients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Información personal')
                        ->icon('heroicon-m-identification')
                        ->description('Información persona del paciente')
                        ->schema([
                            Section::make()
                            ->schema([
                                TextInput::make('institution'),
                                TextInput::make('rango'),
                                TextInput::make('identification')->required(),
                                TextInput::make('name')->required(),
                                TextInput::make('phone')->numeric(),
                                TextInput::make('age')->numeric(),
                                TextInput::make('sexo')->numeric(),
                                TextInput::make('blood'),
                                Textarea::make('address'),
                            ])
                            ->columns(3),
                    ]),
                    Wizard\Step::make('Información militar')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->description('Información militar del paciente')
                        ->schema([
                            Section::make('Familiar militar')
                            ->schema([
                                Repeater::make('military_family')
                                ->schema([
                                    TextInput::make('Institucion'),
                                    TextInput::make('Rango'),
                                    TextInput::make('Nombre'),
                                ])
                                ->columns(3)
                            ])
                            ->columnSpan(2),
                    ]),
                    Wizard\Step::make('Historial')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->description('Información del historial del paciente')
                        ->schema([
                            Section::make()
                            ->schema([
                                Repeater::make('history')
                                ->schema([
                                    TextInput::make('name'),
                                    Textarea::make('description'),
                                ])
                                ->columns(2)
                            ])
                        ]),
                ])
                ->skippable()
                ->persistStepInQueryString()
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identification')
                ->searchable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('rango')->default('N/A'),
                TextColumn::make('age')->default('N/A'),
                TextColumn::make('blood')->default('N/A'),
                TextColumn::make('phone')->default('N/A'),
                TextColumn::make('created_at')->since(),
                ToggleColumn::make('status')
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatients::route('/create'),
            'edit' => Pages\EditPatients::route('/{record}/edit'),
        ];
    }
}
