<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role as ModelsRole;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = ModelsRole::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Create Role')
                    ->schema([
                        TextInput::make('name')->unique(ignoreRecord: true),
                        Select::make(name: 'permissions')
                            ->multiple()
                            ->relationship(titleAttribute: 'name')
                            ->preload()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name'),
                TextColumn::make('created_at')->dateTime('d-M-Y')->sortable()
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('name', '!=', 'Admin');

        // if i want to show admin role to all except moderators i can use the below code

        //      public static function getEloquentQuery(): Builder
        // {
        //     $query = parent::getEloquentQuery();

        //     if (auth()->user()->hasRole('moderator')) {
        //         $query->where('name', '!=', 'Admin');
        //     }

        //     return $query;
        // }

    }
}
