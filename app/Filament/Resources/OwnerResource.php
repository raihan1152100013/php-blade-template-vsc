<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Owner;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OwnerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OwnerResource\RelationManagers;

class OwnerResource extends Resource
{
    protected static ?string $model = Owner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('name')
            ->required()
            ->maxLength(255),
            TextInput::make('email')
            ->label('Email address')
            ->email()
            ->required()
            ->maxLength(255),
            TextInput::make('phone')
            ->label('Phone number')
            ->tel()
            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email'),
                TextColumn::make('phone')->sortable(),
                TextColumn::make('phone number')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                CreateAction::make(),
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
            'index' => Pages\ListOwners::route('/'),
            'create' => Pages\CreateOwner::route('/create'),
            'edit' => Pages\EditOwner::route('/{record}/edit'),
        ];
    }    
}
