<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmergenciesResource\Pages;
use App\Filament\Resources\EmergenciesResource\RelationManagers;
use App\Models\Emergencies;
use App\Models\Patients;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EmergenciesResource extends Resource
{
    protected static ?string $model = Emergencies::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'Emergencies';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información del paciente')
                ->schema([
                    Select::make('patient_id')->label('Buscar paciente por identificacion')
                    ->options(Patients::all()->pluck('identification', 'id'))
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set){
                        $patient = Patients::find($state);
                        if ($patient) {
                            $set('name', $patient->name);
                        }
                    }),
                    TextInput::make('name')->readOnly(),
                ])->columns(2),
                Section::make('Signos Vitales')
                ->schema([
                    TextInput::make('ta')->label('TA'),
                    TextInput::make('fc')->label('FC'),
                    TextInput::make('fr')->label('FR'),
                    TextInput::make('temp')->label('TEMP'),
                ])->columns(4),
                Section::make('Información de emergencia')
                ->schema([
                    Textarea::make('reason')->label('Motivo'),
                    Textarea::make('background')->label('Antecedentes'),
                    Textarea::make('physical_exam')->label('Examen Fisico'),
                    Textarea::make('observations')->label('Observaciones'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('created_at')->since(),
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
            'index' => Pages\ListEmergencies::route('/'),
            'create' => Pages\CreateEmergencies::route('/create'),
            'edit' => Pages\EditEmergencies::route('/{record}/edit'),
        ];
    }
}
