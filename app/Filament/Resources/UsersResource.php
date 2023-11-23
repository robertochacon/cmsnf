<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationGroup = 'Users';

    protected static bool $isScopedToTenant = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required(),
                TextInput::make('email')->required()->email(),
                TextInput::make('password')->required()->password()->hiddenOn('edit'),
                Select::make('type')
                    ->options([
                        'user' => 'User',
                        'admin' => 'Admin',
                        'super' => 'Super admin',
                    ])
                    ->preload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                ->searchable(),
                TextColumn::make('email')
                ->searchable(),
                // TextColumn::make('email_verified_at'),
                CheckboxColumn::make('approved'),
                CheckboxColumn::make('verified'),
                TextColumn::make('type'),

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
}
