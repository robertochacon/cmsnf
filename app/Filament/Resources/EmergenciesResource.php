<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmergenciesResource\Pages;
use App\Models\Emergencies;
use App\Models\Patients;
use Filament\Forms\Components\Hidden;
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
                    Hidden::make('identification'),
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
                    Textarea::make('reason')->label('Motivo')->rows(4),
                    Textarea::make('background')->label('Antecedentes')->rows(4),
                    Textarea::make('physical_exam')->label('Examen Fisico')->rows(4),
                    Textarea::make('observations')->label('Observaciónes')->rows(4),
                    Textarea::make('laboratory')->label('Laboratorio/Imagen')->rows(4),
                    Textarea::make('diagnosis')->label('Diagnóstico')->rows(4),
                    Textarea::make('medicine')->label('Medicamentos suministrados')->rows(4),
                ])->columns(2),
                Section::make()
                ->schema([
                    Textarea::make('details')->label('Detalles de emergencia')->rows(4),
                    Select::make('status')
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
                Tables\Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();
                    return $data;
                }),
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
