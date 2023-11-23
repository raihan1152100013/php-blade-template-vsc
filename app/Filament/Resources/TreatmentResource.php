<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Treatment;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TreatmentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TreatmentResource\RelationManagers;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([TextInput::make('description')
            ->required()
            ->maxLength(255)
            ->columnSpan("full"),

        Textarea::make('notes')
            ->maxLength(65535)
            ->columnSpan('full'),

        TextInput::make('price')
            ->numeric()
            ->prefix('€')
            ->maxValue(42949672.95),
        Select::make('patient_id')
            ->relationship('patient', 'name')
            ->searchable()
            ->preload()
            ->createOptionForm([
         TextInput::make('name')
            ->required()
            ->maxLength(255),      
    
                ])
    ]);
    }
    
    

    public static function table(Table $table): Table
    {
        
    return $table
    ->columns([
                TextColumn::make('description')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('notes')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('patient.name')    
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }    
}
