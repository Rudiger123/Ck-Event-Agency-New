<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload; // Pour l'image

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contenu Principal')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->label('Catégorie')
                            ->searchable()
                            ->preload(),

                        Forms\Components\Textarea::make('excerpt')
                            ->label('Extrait court')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Contenu de l\'article')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Médias')
                    ->schema([
                        // Upload Image à la une
                        SpatieMediaLibraryFileUpload::make('featured_image')
                            ->collection('featured_image')
                            ->label('Image à la une')
                            ->image()
                            ->imageEditor(),
                        
                        // Upload Vidéo (optionnel)
                        SpatieMediaLibraryFileUpload::make('video')
                            ->collection('video')
                            ->label('Vidéo (MP4)')
                            ->acceptedFileTypes(['video/mp4', 'video/quicktime'])
                            ->maxSize(51200), // 50MB
                    ])->collapsible(),

                Forms\Components\Section::make('Publication')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('author', 'name')
                            ->label('Auteur')
                            ->default(auth()->id())
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Brouillon',
                                'published' => 'Publié',
                            ])
                            ->default('draft')
                            ->required(),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Mettre en avant (Featured)'),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Date de publication'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->badge(),
                
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                    }),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Brouillon',
                        'published' => 'Publié',
                    ]),
            ])
            ->actions([
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}