<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientsResource\Pages;
use App\Filament\Resources\PatientsResource\RelationManagers;
use App\Filament\Resources\PatientsResource\RelationManagers\ConsultationsRelationManager;
use App\Filament\Resources\PatientsResource\RelationManagers\PrescriptionsRelationManager;
use App\Models\Institutions;
use App\Models\Patients;
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
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PatientsResource extends Resource
{
    protected static ?string $model = Patients::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Pacientes';

    protected static ?string $navigationLabel = 'Pacientes';

    protected static ?int $navigationSort = 1;

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
                                Select::make('institution_id')->label('Institución')
                                ->options(Institutions::all()->pluck('name', 'id'))
                                ->searchable(),
                                Select::make('range')
                                ->options([
                                    'Teniente General o Almirante' => 'Teniente General o Almirante',
                                    'Mayor General o Vicealmirante' => 'Mayor General o Vicealmirante',
                                    'General de Brigada o Contralmirante' => 'General de Brigada o Contralmirante',
                                    'Coronel o Capitán de Navío' => 'Coronel o Capitán de Navío',
                                    'Teniente Coronel o Capitán de Fragata' => 'Teniente Coronel o Capitán de Fragata',
                                    'Mayor o Capitán de Corbeta' => 'Mayor o Capitán de Corbeta',
                                    'Capitán o Teniente de Navío' => 'Capitán o Teniente de Navío',
                                    'Primer Teniente o Teniente de Fragata' => 'Primer Teniente o Teniente de Fragata',
                                    'Segundo Teniente o Teniente de Corbeta' => 'Segundo Teniente o Teniente de Corbeta',
                                    'Sub Oficial' => 'Sub Oficial',
                                    'Cadete o Guardiamarina' => 'Cadete o Guardiamarina',
                                    'Sargento Mayor' => 'Sargento Mayor',
                                    'Sargento Primero' => 'Sargento Primero',
                                    'Sargento de Administración y Contabilidad' => 'Sargento de Administración y Contabilidad',
                                    'Sargento' => 'Sargento',
                                    'Cabo' => 'Cabo',
                                    'Raso Primera Clase/Marinero' => 'Raso Primera Clase/Marinero',
                                ])
                                ->label('Rango')
                                ->searchable(),
                                TextInput::make('identification')->required()->label('Identificación'),
                                TextInput::make('name')->required()->label('Nombre'),
                                TextInput::make('phone')->numeric()->label('Teléfono'),
                                TextInput::make('age')->numeric()->label('Edad'),
                                Select::make('sexo')->label('Genero')
                                ->options([
                                    'Masculino' => 'Masculino',
                                    'Femenino' => 'Femenino',
                                ])
                                ->searchable(),
                                Select::make('blood')->default('A+')
                                ->options([
                                    'A+' => 'A+',
                                    'A-' => 'A-',
                                    'B+' => 'B+',
                                    'B-' => 'B-',
                                    'AB+' => 'AB+',
                                    'AB-' => 'AB-',
                                    'O+' => 'O+',
                                    'O-' => 'O-',
                                ])
                                ->label('Sangre')
                                ->searchable(),
                                Textarea::make('address')->label('Dirección'),
                            ])
                            ->columns(3),
                    ]),
                    Wizard\Step::make('Información de familia militar')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->description('Información de familiares militar del paciente')
                        ->schema([
                            Section::make()
                            ->schema([
                                Repeater::make('military_family')->label('Familiar militar')
                                ->schema([
                                    Select::make('institution')
                                    ->options(Institutions::all()->pluck('name', 'id'))
                                    ->searchable(),
                                    Select::make('range')
                                    ->options([
                                        'Teniente General o Almirante' => 'Teniente General o Almirante',
                                        'Mayor General o Vicealmirante' => 'Mayor General o Vicealmirante',
                                        'General de Brigada o Contralmirante' => 'General de Brigada o Contralmirante',
                                        'Coronel o Capitán de Navío' => 'Coronel o Capitán de Navío',
                                        'Teniente Coronel o Capitán de Fragata' => 'Teniente Coronel o Capitán de Fragata',
                                        'Mayor o Capitán de Corbeta' => 'Mayor o Capitán de Corbeta',
                                        'Capitán o Teniente de Navío' => 'Capitán o Teniente de Navío',
                                        'Primer Teniente o Teniente de Fragata' => 'Primer Teniente o Teniente de Fragata',
                                        'Segundo Teniente o Teniente de Corbeta' => 'Segundo Teniente o Teniente de Corbeta',
                                        'Sub Oficial' => 'Sub Oficial',
                                        'Cadete o Guardiamarina' => 'Cadete o Guardiamarina',
                                        'Sargento Mayor' => 'Sargento Mayor',
                                        'Sargento Primero' => 'Sargento Primero',
                                        'Sargento de Administración y Contabilidad' => 'Sargento de Administración y Contabilidad',
                                        'Sargento' => 'Sargento',
                                        'Cabo' => 'Cabo',
                                        'Raso Primera Clase/Marinero' => 'Raso Primera Clase/Marinero',
                                    ])
                                    ->label('Rango')
                                    ->searchable(),
                                    // TextInput::make('range')->label('Rango'),
                                    TextInput::make('name')->label('Nombre'),
                                    TextInput::make('parent')->label('Parentesco'),
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
                                Repeater::make('history')->label('Historial')
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
                TextColumn::make('identification')->label('Identificación')
                ->searchable(),
                TextColumn::make('name')->label('Nombre')
                ->searchable(),
                TextColumn::make('range')->default('N/A')->label('Rango'),
                TextColumn::make('age')->default('N/A')->label('Edad'),
                TextColumn::make('blood')->default('N/A')->label('Sangre'),
                TextColumn::make('phone')->default('N/A')->label('Teléfono'),
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
            ConsultationsRelationManager::class,
            PrescriptionsRelationManager::class
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
