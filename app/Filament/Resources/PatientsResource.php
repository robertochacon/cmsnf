<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientsResource\Pages;
use App\Filament\Resources\PatientsResource\RelationManagers;
use App\Filament\Resources\PatientsResource\RelationManagers\ConsultationsRelationManager;
use App\Filament\Resources\PatientsResource\RelationManagers\PrescriptionsRelationManager;
use App\Models\Institutions;
use App\Models\Patients;
use App\Services\ARD;
use App\Services\JCE;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
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
                                Toggle::make('younger')
                                ->live()
                                ->label('Es menor de edad?'),
                            ])
                            ->columns(2),
                            Section::make(fn(Get $get) => $get('younger') ? 'Información del tutor' : 'Información personal')
                            ->description(fn(Get $get) => $get('loading') ? 'Consultando paciente...' : '')
                            ->schema([
                                Toggle::make('military')
                                ->live()
                                ->default(true)
                                ->label('Es militar?'),
                                TextInput::make('identification')
                                ->required()
                                ->label('Número de Cédula')
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, Get $get) {

                                    $set('loading', true);

                                    $verificatePatient = Patients::where('identification', $state)->first();
                                    if (isset($verificatePatient)) {
                                        Notification::make()
                                            ->title('Existe un registro con esta identificación.')
                                            ->danger()
                                            ->send();
                                        $set('loading', false);
                                        return;
                                    }

                                    if (strlen($state) == 11) {
                                        $militar = (new ARD())->getPerson($state);
                                        if (isset($militar[0]['nombre'])) {
                                            $set('name', $militar[0]['nombre'].' '.$militar[0]['apellido']);
                                            $set('range', ucwords(strtolower($militar[0]['desc_rango'])));
                                        } else {
                                            $set('name', '');
                                            $set('range', '');
                                        }

                                        $persona = (new JCE())->getPerson($state);
                                        if (isset($persona)) {
                                            if (!isset($persona['status'])) {
                                                if (!$get('military')) {
                                                    $set('name', $persona['nombre'].' '.$persona['apellidos']);
                                                }
                                                $set('sexo', $persona['sexo'] == 'M' ? 'Masculino' : 'Femenino');
                                                $set('age', $persona['edad']);
                                                $set('address', $persona['lugarNacimiento']);
                                            } else {
                                                if (!$get('military')) {
                                                    $set('name', '');
                                                }
                                                $set('sexo', '');
                                                $set('age', '');
                                                $set('address', '');
                                            }
                                        }

                                    }

                                    $set('loading', false);

                                }),
                                TextInput::make('name')->required()->label('Nombre'),
                                Select::make('institution_id')->label('Institución')
                                ->options(Institutions::all()->pluck('name', 'id'))
                                ->searchable()
                                ->visible(fn (Get $get): bool => $get('military')),
                                // TextInput::make('range')->label('Rango')
                                // ->visible(fn (Get $get): bool => $get('military')),
                                Select::make('range')
                                ->options([
                                    'No aplica' => 'No aplica',
                                    'Teniente General' => 'Teniente General',
                                    'Almirante' => 'Almirante',
                                    'Mayor General' => 'Mayor General',
                                    'Vicealmirante' => 'Vicealmirante',
                                    'General de Brigada' => 'General de Brigada',
                                    'Contralmirante' => 'Contralmirante',
                                    'Coronel' => 'Coronel',
                                    'Capitán de Navío' => 'Capitán de Navío',
                                    'Teniente Coronel' => 'Teniente Coronel',
                                    'Capitán de Fragata' => 'Capitán de Fragata',
                                    'Mayor' => 'Mayor',
                                    'Capitán de Corbeta' => 'Capitán de Corbeta',
                                    'Capitán' => 'Capitán',
                                    'Teniente de Navío' => 'Teniente de Navío',
                                    'Primer Teniente' => 'Primer Teniente',
                                    'Teniente de Fragata' => 'Teniente de Fragata',
                                    'Segundo Teniente' => 'Segundo Teniente',
                                    'Teniente de Corbeta' => 'Teniente de Corbeta',
                                    'Sub Oficial' => 'Sub Oficial',
                                    'Cadete' => 'Cadete',
                                    'Guardiamarina' => 'Guardiamarina',
                                    'Sargento Mayor' => 'Sargento Mayor',
                                    'Sargento Primero' => 'Sargento Primero',
                                    'Sargento de Administración y Contabilidad' => 'Sargento de Administración y Contabilidad',
                                    'Sargento' => 'Sargento',
                                    'Cabo' => 'Cabo',
                                    'Raso Primera Clase' => 'Raso Primera Clase',
                                    'Marinero Auxiliar' => 'Marinero Auxiliar',
                                ])
                                ->label('Rango')
                                ->searchable()
                                ->visible(fn (Get $get): bool => $get('military')),
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
                                ])->visible(fn (Get $get): bool => !$get('younger'))
                                ->label('Tipo de sangre')
                                ->searchable(),
                                Textarea::make('address')->label('Dirección'),
                            ])
                            ->columns(3),
                            Section::make()
                            ->schema([
                                Repeater::make('child')->label('Informacion del niño(a)')
                                ->schema([
                                    TextInput::make('name')->required()->label('Nombre'),
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
                                    ->label('Tipo de sangre')
                                    ->searchable(),
                                ])
                                ->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                                ->columns(4)
                                ->defaultItems(1)
                            ])
                            ->visible(fn (Get $get): bool => $get('younger')),
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
                                        'No aplica' => 'No aplica',
                                        'Teniente General' => 'Teniente General',
                                        'Almirante' => 'Almirante',
                                        'Mayor General' => 'Mayor General',
                                        'Vicealmirante' => 'Vicealmirante',
                                        'General de Brigada' => 'General de Brigada',
                                        'Contralmirante' => 'Contralmirante',
                                        'Coronel' => 'Coronel',
                                        'Capitán de Navío' => 'Capitán de Navío',
                                        'Teniente Coronel' => 'Teniente Coronel',
                                        'Capitán de Fragata' => 'Capitán de Fragata',
                                        'Mayor' => 'Mayor',
                                        'Capitán de Corbeta' => 'Capitán de Corbeta',
                                        'Capitán' => 'Capitán',
                                        'Teniente de Navío' => 'Teniente de Navío',
                                        'Primer Teniente' => 'Primer Teniente',
                                        'Teniente de Fragata' => 'Teniente de Fragata',
                                        'Segundo Teniente' => 'Segundo Teniente',
                                        'Teniente de Corbeta' => 'Teniente de Corbeta',
                                        'Sub Oficial' => 'Sub Oficial',
                                        'Cadete' => 'Cadete',
                                        'Guardiamarina' => 'Guardiamarina',
                                        'Sargento Mayor' => 'Sargento Mayor',
                                        'Sargento Primero' => 'Sargento Primero',
                                        'Sargento de Administración y Contabilidad' => 'Sargento de Administración y Contabilidad',
                                        'Sargento' => 'Sargento',
                                        'Cabo' => 'Cabo',
                                        'Raso Primera Clase' => 'Raso Primera Clase',
                                        'Marinero Auxiliar' => 'Marinero Auxiliar',
                                    ])
                                    ->label('Rango')
                                    ->searchable(),
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
                TextColumn::make('identification')->label('Número de Cédula')
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
                Tables\Actions\EditAction::make()->label(fn ($record) => $record->can_edit ? 'Editar' : 'Ver'),
                Tables\Actions\DeleteAction::make()->label('Eliminar')->visible(fn ($record) => $record->can_edit)
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
