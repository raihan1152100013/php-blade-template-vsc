<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Blog;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns;
use App\Filament\Resources\BlogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BlogResource extends Resource{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Heading')
                    ->tabs([
                        Tab::make('Cover Blog')
                            ->columnSpanFull()
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->enableDownload()
                                    ->enableOpen()
                                    ->directory('blogs')
                                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                        return (string) str($file->getClientOriginalName())->prepend('blogs-');
                                    }),
                            ]),
                        Tab::make('Description Blog')
                            ->columnSpanFull()
                            ->schema([
                                TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('author')
                                ->required()
                                ->maxLength(255),
                            TagsInput::make('tags')
                                ->required()
                                ->separator(','),
                            ]),
                        Tab::make('Content Blog')
                            ->columnSpanFull()
                            ->schema([
                                RichEditor::make('content')
                                    ->columnSpanFull()
                                    ->required()
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('author'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }    
}
