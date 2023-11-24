<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicensesResource\Pages;
use App\Filament\Resources\LicensesResource\RelationManagers;
use App\Models\Licenses;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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

class LicensesResource extends Resource
{
    protected static ?string $model = Licenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Licenses';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->columns(3)
                ->schema([
                    TextInput::make('identification')->required(),
                    TextInput::make('name')->required(),
                    TextInput::make('phone')->numeric()->required(),
                ]),
                Section::make()
                ->columns(2)
                ->schema([
                    Textarea::make('address')->required(),
                    Textarea::make('diagnostic')->required(),
                ]),
                Section::make()
                ->columns(3)
                ->schema([
                    DatePicker::make('date_start')->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, Get $get){

                        if ($get('date_end')!='') {
                            $fechaEmision = Carbon::parse($state);
                            $fechaExpiracion = Carbon::parse($get('date_end'));
                            $set('days', $fechaExpiracion->diffInDays($fechaEmision));
                        }

                    }),
                    DatePicker::make('date_end')->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, Get $get){

                        if ($get('date_start')!='') {
                            $fechaEmision = Carbon::parse($get('date_start'));
                            $fechaExpiracion = Carbon::parse($state);
                            $set('days', $fechaExpiracion->diffInDays($fechaEmision));
                        }
                    }),
                    TextInput::make('days')->numeric()->readOnly(),
                    Select::make('status')
                    ->options([
                        'Recibida' => 'Recibida',
                        'Aprobada' => 'Aprobada',
                        'Rechazada' => 'Rechazada',
                    ])->visibleOn('edit')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('identification')
                ->searchable(),
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('days'),
                TextColumn::make('date_start'),
                TextColumn::make('date_end'),
                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Recibida' => 'gray',
                    'Aprobada' => 'success',
                    'Rechazada' => 'danger',
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
            'index' => Pages\ListLicenses::route('/'),
            'create' => Pages\CreateLicenses::route('/create'),
            'edit' => Pages\EditLicenses::route('/{record}/edit'),
        ];
    }
}
