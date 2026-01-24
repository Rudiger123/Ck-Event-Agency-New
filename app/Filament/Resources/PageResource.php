<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationGroup = 'Site Web';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre de la page')
                    ->required(),

                Forms\Components\TextInput::make('key')
                    ->label('Clé unique (ex: about, services)')
                    ->helperText('Ne pas modifier si développeur n\'a pas demandé')
                    ->required()
                    ->unique(ignoreRecord: true),
                
                Forms\Components\TextInput::make('slug')
                    ->required(),

                Forms\Components\RichEditor::make('content')
                    ->label('Contenu')
                    ->columnSpanFull(),
                
                SpatieMediaLibraryFileUpload::make('hero_image')
                    ->collection('hero_image')
                    ->label('Image d\'en-tête'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('key')->badge(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}