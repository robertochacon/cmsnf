<?php

namespace App\Filament\Resources\PatientsResource\RelationManagers;

use App\Models\Prescriptions;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrescriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'prescriptions';

    protected static ?string $title = 'Prescripciones';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('description')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Prescriptions')
            ->columns([
                TextColumn::make('user.name')->label('Usuario'),
                TextColumn::make('created_at')->since(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();
                    return $data;
                }),
            ])
            ->actions([
                Tables\Actions\Action::make('Download')
                ->icon('heroicon-o-arrow-down-on-square-stack')
                ->url(fn(Prescriptions $record) => route('prescription.pdf.download', $record))
                ->openUrlInNewTab(),
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
