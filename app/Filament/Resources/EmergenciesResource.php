<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmergenciesResource\Pages;
use App\Models\Emergencies;
use App\Models\Patients;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EmergenciesResource extends Resource
{
    protected static ?string $model = Emergencies::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'Emergencias';

    protected static ?string $navigationLabel = 'Emergencias';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información del paciente')
                ->schema([
                    Select::make('patient_id')->label('Buscar paciente por cédula')
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
                    Hidden::make('identification'),
                    TextInput::make('name')->readOnly()->label('Nombre del paciente'),
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
                    RichEditor::make('reason')->label('Motivo'),
                    RichEditor::make('background')->label('Antecedentes'),
                    RichEditor::make('physical_exam')->label('Examen Fisico'),
                    RichEditor::make('observations')->label('Observaciónes'),
                    RichEditor::make('laboratory')->label('Laboratorio/Imagen'),
                    RichEditor::make('diagnosis')->label('Diagnóstico'),
                    RichEditor::make('medicine')->label('Medicamentos suministrados'),
                    RichEditor::make('pending')->label('Datos pendientes'),
                ])->columns(2),
                Section::make()
                ->schema([
                    RichEditor::make('details')->label('Detalles de emergencia'),
                    Select::make('status')->label('Estado')
                    ->default('Atendiendo')
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
                    RichEditor::make('reason_transfer')->label('Motivo'),
                ])->columns(2)
                ->hidden(fn (Get $get): bool => $get('status') != 'Traslado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identification')->label('Número de Cédula')
                ->searchable(),
                TextColumn::make('name')->label('Nombre de paciente')
                ->searchable(),
                TextColumn::make('user.name')->label('Usuario')
                ->searchable(),
                TextColumn::make('status')->label('Estado')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Atendiendo' => 'info',
                    'Atendida' => 'success',
                    'Traslado' => 'warning',
                }),
                TextColumn::make('created_at')->since()->label('Creado'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar'),
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
