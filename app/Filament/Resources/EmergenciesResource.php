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
use Filament\Forms\Get;
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
                            $set('identification', $patient->identification);
                            $set('name', $patient->name);
                        }
                    }),
                    TextInput::make('identification')->readOnly(),
                    TextInput::make('name')->readOnly(),
                ])->columns(3),
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
                    Textarea::make('observations')->label('Observaciónes'),
                    Textarea::make('laboratory')->label('Laboratorio/Imagen'),
                    Textarea::make('diagnosis')->label('Diagnóstico'),
                    Textarea::make('medicine')->label('Medicamentos suministrados'),
                ])->columns(2),
                Section::make()
                ->schema([
                    Textarea::make('details')->label('Detalles de emergencia'),
                    Select::make('status')
                    ->options([
                        'Atendiendo' => 'Atendiendo',
                        'Atendida' => 'Atendida',
                        'Traslado' => 'Traslado',
                    ])
                    ->live()
                    ->searchable(),
                ])->columns(1),
                Section::make('Información de traslado')
                ->schema([
                    TextInput::make('hospital_transfer')->label('Hospital'),
                    Textarea::make('reason_transfer')->label('Motivo'),
                ])->columns(2)
                ->hidden(fn (Get $get): bool => $get('status') != 'Traslado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identification')
                ->searchable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('user.name')
                ->searchable(),
                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Atendiendo' => 'info',
                    'Atendida' => 'success',
                    'Traslado' => 'warning',
                }),
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
