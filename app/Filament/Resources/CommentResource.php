<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $navigationLabel = 'Commentaires';

    // Badge pour les commentaires en attente
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_visible', false)->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->readonly(),
                Forms\Components\TextInput::make('email')->readonly(),
                Forms\Components\Textarea::make('content')->readonly()->columnSpanFull(),
                Forms\Components\Toggle::make('is_visible')->label('Approuvé / Visible'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('article.title')->limit(20)->label('Article'),
                Tables\Columns\TextColumn::make('content')->limit(50),
                Tables\Columns\ToggleColumn::make('is_visible')->label('Visible'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Date'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
        ];
    }
}