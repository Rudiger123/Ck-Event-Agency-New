<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Administration';
    protected static ?string $navigationLabel = 'Messagerie';

    // Badge pour montrer le nombre de messages non lus dans le menu
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'unread')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Info Contact')
                    ->schema([
                        Forms\Components\TextInput::make('name')->readonly(),
                        Forms\Components\TextInput::make('email')->email()->readonly(),
                        Forms\Components\TextInput::make('subject')->readonly(),
                        Forms\Components\DateTimePicker::make('created_at')->label('Reçu le')->readonly(),
                    ])->columns(2),

                Forms\Components\Section::make('Message')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->rows(5)
                            ->readonly()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Traitement')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'unread' => 'Non lu',
                                'read' => 'Lu',
                                'replied' => 'Répondu',
                            ])
                            ->required(),
                        
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Notes internes (Visible seulement par vous)')
                            ->placeholder('Ex: Répondu par téléphone le...')
                            ->rows(3),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unread' => 'danger',
                        'read' => 'gray',
                        'replied' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Date'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // On ajoute le hook 'before' (avant d'ouvrir la modale)
                Tables\Actions\ViewAction::make()
                    ->before(function (Message $record) {
                        if ($record->status === 'unread') {
                            $record->update(['status' => 'read']);
                        }
                    }),
                
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            // On retire 'create' car on ne crée pas de messages depuis l'admin
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}