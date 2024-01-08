<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Models\Departments;
use App\Models\Institutions;
use App\Models\Professions;
use App\Models\Specialties;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationGroup = 'Usuarios';

    protected static ?string $navigationLabel = 'Usuarios';

    protected static ?int $navigationSort = 6;

    protected static bool $isScopedToTenant = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información personal')
                ->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->required()->email(),
                    TextInput::make('password')->required()->password()->hiddenOn('edit'),
                    TextInput::make('phone')->numeric(),
                    Select::make('sexo')->label('Genero')->default('Masculino')
                        ->options([
                            'Masculino' => 'Masculino',
                            'Femenino' => 'Femenino',
                        ]),
                ])->columns(3),
                Section::make('Información profesional')
                ->schema([
                    Select::make('institution')
                        ->options(Institutions::all()->pluck('name', 'id'))
                        ->label('Institución')
                        ->searchable(),
                    TextInput::make('range')
                    ->label('Rango'),
                    Select::make('department')
                        ->options(Departments::all()->pluck('name', 'id'))
                        ->label('Departamento')
                        ->searchable(),
                    Select::make('profession')
                        ->options(Professions::all()->pluck('name', 'id'))
                        ->label('Profesión')
                        ->searchable(),
                    Select::make('specialty')
                        ->options(Specialties::all()->pluck('name', 'id'))
                        ->label('Especialidad')
                        ->searchable(),
                    Select::make('type')->default('Doctor')
                        ->options([
                            'user' => 'User',
                            'doctor' => 'Doctor',
                            'admin' => 'Admin',
                            'super' => 'Super admin',
                        ])
                        ->label('Tipo')
                        ->searchable(),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                ->label('Nombre')
                ->searchable(),
                TextColumn::make('email')
                ->label('Correo')
                ->searchable(),
                // TextColumn::make('email_verified_at'),
                CheckboxColumn::make('approved')
                ->label('Aprobado'),
                CheckboxColumn::make('verified')
                ->label('Verificado'),
                TextColumn::make('type')
                ->label('Tipo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Verify')
                ->icon('heroicon-m-check-badge')
                ->action(function(User $user){
                    $user->email_verified_at = Date('Y-m-d H:i:s');
                    $user->verified = true;
                    $user->save();
                }),
                Tables\Actions\Action::make('Unverify')
                ->icon('heroicon-m-x-circle')
                ->action(function(User $user){
                    $user->email_verified_at = null;
                    $user->verified = false;
                    $user->save();
                }),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isSuper() || auth()->user()->isAdmin();
    }

}
