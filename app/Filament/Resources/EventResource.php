<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class EventResource extends Resource
{
    use Translatable;

    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de l\'événement')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Nom de l\'événement')
                            ->required(),
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('event_type_id')
                            ->relationship('eventType', 'name')
                            ->label('Type d\'événement')
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')->required(),
                                Forms\Components\TextInput::make('slug')->required(),
                            ]),

                        Forms\Components\DatePicker::make('event_date')
                            ->label('Date de l\'événement')
                            ->required(),
                            
                        Forms\Components\TextInput::make('location')
                            ->label('Lieu'),
                            
                        Forms\Components\TextInput::make('client_name')
                            ->label('Client (Optionnel)'),
                    ])->columns(2),

                Forms\Components\Section::make('Description & Témoignage')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Récit de l\'événement')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('testimonial')
                            ->label('Témoignage Client')
                            ->rows(3),
                    ]),

                Forms\Components\Section::make('Galerie Photos')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('cover_image')
                            ->collection('cover_image')
                            ->label('Image de couverture (Principale)')
                            ->image()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->label('Galerie Photos (Sélectionner plusieurs)')
                            ->multiple() // Autorise plusieurs images !
                            ->reorderable()
                            ->image(),
                    ]),
                
                Forms\Components\Section::make('Paramètres')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('creator', 'name')
                            ->default(auth()->id())
                            ->required(),
                        
                        Forms\Components\Select::make('status')
                            ->options(['draft' => 'Brouillon', 'published' => 'Publié'])
                            ->default('published'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->collection('cover_image')
                    ->label('Image'),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('eventType.name')
                    ->badge(),
                
                Tables\Columns\TextColumn::make('event_date')
                    ->date(),
                
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}