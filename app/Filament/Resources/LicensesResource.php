<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicensesResource\Pages;
use App\Models\Licenses;
use App\Services\JCE;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class LicensesResource extends Resource
{
    protected static ?string $model = Licenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Licencias médicas';

    protected static ?string $navigationLabel = 'Licencias médicas';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->columns(3)
                ->schema([
                    TextInput::make('identification')->required()->label('Número de Cédula')                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, Get $get){

                        if(strlen($state)==11){
                            $persona = (new JCE())->getPerson($state);
                            if (isset($persona)) {
                                if (!isset($persona['status'])) {
                                    $set('name', $persona['nombre'].' '.$persona['apellidos']);
                                }else{
                                    $set('name', '');
                                }
                            }
                        }

                    }),
                    TextInput::make('name')->required()->label('Nombre'),
                    TextInput::make('phone')->numeric()->required()->label('Teléfono'),
                ]),
                Section::make()
                ->columns(2)
                ->schema([
                    Textarea::make('address')->required()->label('Dirección'),
                    Textarea::make('diagnostic')->required()->label('Diagnóstico'),
                ]),
                Section::make()
                ->schema([
                    Textarea::make('note')->required()->label('Nota'),
                ]),
                Section::make()
                ->columns(3)
                ->schema([
                    DatePicker::make('date_start')->required()->label('Fecha de inicio')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, Get $get){

                        if ($get('date_end')!='') {
                            $fechaEmision = Carbon::parse($state);
                            $fechaExpiracion = Carbon::parse($get('date_end'));
                            $set('days', $fechaExpiracion->diffInDays($fechaEmision));
                        }

                    }),
                    DatePicker::make('date_end')->required()->label('Fecha final')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, Get $get){

                        if ($get('date_start')!='') {
                            $fechaEmision = Carbon::parse($get('date_start'));
                            $fechaExpiracion = Carbon::parse($state);
                            $set('days', $fechaExpiracion->diffInDays($fechaEmision));
                        }
                    }),
                    TextInput::make('days')->numeric()->readOnly()->label('Días'),
                    Select::make('status')->label('Estado')
                    ->default('Recibida')
                    ->searchable()
                    ->options([
                        'Recibida' => 'Recibida',
                        'Aprobada' => 'Aprobada',
                        'Rechazada' => 'Rechazada',
                    ])
                    ->visibleOn('edit')
                    ->visible(auth()->user()->isSuper() || auth()->user()->isAdmin()),
                    Toggle::make('open')
                    ->label('Continua')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('identification')->label('Número de Cédula')
                ->searchable(),
                TextColumn::make('name')->label('Nombre')
                ->searchable(),
                TextColumn::make('phone')->label('Teléfono'),
                TextColumn::make('days')->label('Días'),
                TextColumn::make('date_start')->label('Fecha de inicio'),
                TextColumn::make('date_end')->label('Fecha final'),
                ToggleColumn::make('open')
                ->label('Continua'),
                TextColumn::make('status')->label('Estado')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Recibida' => 'gray',
                    'Aprobada' => 'success',
                    'Rechazada' => 'danger',
                }),
                TextColumn::make('created_at')->since()->label('Creado'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Download')
                ->icon('heroicon-o-arrow-down-on-square-stack')
                ->url(fn(Licenses $record) => route('licenses.pdf.download', $record))
                ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar')
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
