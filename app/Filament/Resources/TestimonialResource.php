<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Concerns\Translatable;

class TestimonialResource extends Resource
{
    use Translatable;
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Site Web';
    protected static ?string $navigationLabel = 'Témoignages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Info Client')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom du Client')
                            ->required(),
                        
                        Forms\Components\TextInput::make('role')
                            ->label('Rôle / Contexte')
                            ->placeholder('Ex: Mariée, Directeur Marketing...'),
                        
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->avatar() // Mode rond
                            ->label('Photo du client (Optionnel)'),
                            
                        Forms\Components\Select::make('rating')
                            ->label('Note')
                            ->options([
                                5 => '⭐⭐⭐⭐⭐ (Excellent)',
                                4 => '⭐⭐⭐⭐ (Très bien)',
                                3 => '⭐⭐⭐ (Bien)',
                            ])
                            ->default(5)
                            ->required(),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('Afficher sur le site')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Textarea::make('content')
                    ->label('Témoignage')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('name')
                    ->weight('bold')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('role')
                    ->color('gray'),
                    
                Tables\Columns\TextColumn::make('rating')
                    ->formatStateUsing(fn (string $state): string => str_repeat('⭐', $state)),
                    
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Visible'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}