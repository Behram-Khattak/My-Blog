<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                                        ->relationship('category', 'category')
                                        ->searchable()
                                        ->preload()
                                        ->placeholder('Select Category')
                                        ->required(),

                Forms\Components\TextInput::make('title')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (Set $set, $state) {
                                                $set('slug', Str::slug($state));
                                            })
                                            ->required(),

                Forms\Components\RichEditor::make('content')
                                        ->columnSpanFull()
                                        ->required(),

                Forms\Components\TextInput::make('slug')
                                            ->required(),

                Forms\Components\TagsInput::make('tags')
                                            ->suggestions([
                                                'tailwindcss',
                                                'alpinejs',
                                                'laravel',
                                                'livewire',
                                            ])
                                            ->reorderable()
                                            ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                                            ->columnSpanFull()
                                            ->required()
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.category'),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('content')
                                            ->html(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('tags'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
