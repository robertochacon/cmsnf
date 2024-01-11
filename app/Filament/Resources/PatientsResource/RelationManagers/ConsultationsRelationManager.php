<?php

namespace App\Filament\Resources\PatientsResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultationsRelationManager extends RelationManager
{
    protected static string $relationship = 'consultations';

    protected static ?string $title = 'Consultas médicas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Signos vitales')
                ->schema([
                    TextInput::make('ta'),
                    TextInput::make('fc'),
                    TextInput::make('fr'),
                ])
                ->columns(3),
                Section::make()
                ->schema([
                    TextInput::make('reason')->label('Motivo')->required(),
                    RichEditor::make('reason_description')->label('Descripcion'),
                    RichEditor::make('hea')->label('Historia de la enfermedad actual'),
                    RichEditor::make('physical_exam')->label('Examen fisico'),
                    RichEditor::make('complementary_studies')->label('Estudios complentarios'),
                    RichEditor::make('diagnosis')->label('Diagnóstico'),
                    RichEditor::make('treatment')->label('Tratamiento'),
                    RichEditor::make('note')->label('Nota'),
                ]),
                Select::make('status')
                ->default('Pendiente')
                ->options([
                    'Pendiente' => 'Pendiente',
                    'Completada' => 'Completada',
                ])
                ->live()
                ->searchable(),
                Select::make('transfer')
                ->label('Transferir a')
                ->options(User::where('type','doctor')->get()->pluck('name', 'id'))
                ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Consultations')
            ->columns([
                TextColumn::make('reason')->default('N/A')->label('Motivo'),
                TextColumn::make('user.name')->default('N/A')->label('Registrado por'),
                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Pendiente' => 'info',
                    'Completada' => 'success'
                }),
                TextColumn::make('created_at')->since(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->createAnother(false)
                ->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();
                    return $data;
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

}
