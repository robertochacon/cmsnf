<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultationsResource\Pages;
use App\Filament\Resources\ConsultationsResource\RelationManagers;
use App\Models\Consultations;
use App\Models\Patients;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultationsResource extends Resource
{
    protected static ?string $model = Consultations::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Consultas médicas';

    protected static ?string $navigationLabel = 'Consultas médicas';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información del paciente')
                ->schema([
                    Select::make('patient_id')->label('Buscar paciente por identificación')
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
                    // Hidden::make('identification'),
                    TextInput::make('name')->readOnly()->label('Nombre'),
                    Select::make('status')->label('Estado de consulta')
                    ->default('Pendiente')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'Completada' => 'Completada',
                    ])
                    ->searchable(),
                ])->columns(3),
                Section::make('Signos vitales')
                ->schema([
                    TextInput::make('ta')->label('TA'),
                    TextInput::make('fc')->label('FC'),
                    TextInput::make('fr')->label('FR'),
                ])
                ->columns(3),
                Section::make()
                ->schema([
                    TextInput::make('reason')->label('Motivo')->required(),
                ]),
                Section::make()
                ->schema([
                    RichEditor::make('hea')->label('Historia de la enfermedad actual'),
                    RichEditor::make('physical_exam')->label('Examen fisico')->default('<b>Cabeza:</b><br><br> <b>Tórax:</b><br><br> <b>Abdomen:</b><br><br> <b>Extremidades:</b><br>'),
                    RichEditor::make('complementary_studies')->label('Estudios complentarios'),
                    RichEditor::make('diagnosis')->label('Diagnóstico'),
                    RichEditor::make('treatment')->label('Tratamiento'),
                    RichEditor::make('counter_referral')->label('Contra referimiento'),
                    Select::make('transfer')
                    ->label('Transferir a')
                    ->options(User::where('type','doctor')->get()->pluck('name', 'id'))
                    ->searchable(),
                ])
                ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reason')->default('N/A')->label('Motivo')->searchable(),
                TextColumn::make('user.name')->default('N/A')->label('Registrado por'),
                TextColumn::make('status')->label('Estado')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Pendiente' => 'info',
                    'Completada' => 'success'
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
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultations::route('/create'),
            'edit' => Pages\EditConsultations::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isSuper() || auth()->user()->isAdmin() || auth()->user()->isDoctor();
    }
}
