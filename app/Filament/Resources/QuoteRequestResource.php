<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteRequestResource\Pages;
use App\Models\QuoteRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteReplyMail;
use Filament\Notifications\Notification;

class QuoteRequestResource extends Resource
{
    protected static ?string $model = QuoteRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Demandes de Devis';
    protected static ?string $navigationGroup = 'Business';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Client')
                    ->schema([
                        Forms\Components\TextInput::make('reference')->readonly(),
                        Forms\Components\TextInput::make('name')->readonly()->label('Nom'),
                        Forms\Components\TextInput::make('email')->readonly(),
                        Forms\Components\TextInput::make('phone')->readonly(),
                        Forms\Components\TextInput::make('company')->readonly(),
                    ])->columns(3),

                Forms\Components\Section::make('Projet')
                    ->schema([
                        Forms\Components\TagsInput::make('service_types')->label('Services')->disabled(),
                        Forms\Components\DatePicker::make('event_date')->readonly(),
                        Forms\Components\TextInput::make('budget')->readonly(),
                        Forms\Components\Textarea::make('message')
                            ->columnSpanFull()
                            ->readonly(),
                    ])->columns(2),
                
                Forms\Components\Section::make('État')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'Nouveau',
                                'processing' => 'En cours',
                                'completed' => 'Traité / Envoyé',
                                'archived' => 'Archivé',
                            ])
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('company')->searchable(),
                Tables\Columns\TextColumn::make('budget')->badge()->color('warning'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'processing' => 'info',
                        'completed' => 'success',
                        'archived' => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Reçu le'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                
                // --- ACTION MAGIQUE : RÉPONDRE / ENVOYER DEVIS ---
                Tables\Actions\Action::make('reply')
                    ->label('Envoyer Devis')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->form([
                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet de l\'email')
                            ->default(fn (QuoteRequest $record) => 'Votre devis CK Agency - Réf: ' . $record->reference)
                            ->required(),
                        
                        Forms\Components\RichEditor::make('content')
                            ->label('Message')
                            ->default("Bonjour,\n\nMerci pour votre demande. Veuillez trouver ci-joint notre proposition commerciale pour votre événement.\n\nCordialement,\nCynthia Kenne")
                            ->required(),
                        
                        Forms\Components\FileUpload::make('attachment')
                            ->label('Joindre le Devis (PDF)')
                            ->disk('public')
                            ->directory('quotes')
                            ->acceptedFileTypes(['application/pdf'])
                            ->required(), // On oblige à mettre un PDF pour que ce soit pro
                    ])
                    ->action(function (QuoteRequest $record, array $data) {
                        // 1. Envoyer l'email
                        Mail::to($record->email)
                            ->send(new QuoteReplyMail(
                                $data['subject'], 
                                $data['content'], 
                                $data['attachment']
                            ));

                        // 2. Mettre à jour le statut
                        $record->update(['status' => 'completed']);

                        // 3. Notification Admin
                        Notification::make()
                            ->title('Devis envoyé avec succès')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuoteRequests::route('/'),
            'edit' => Pages\EditQuoteRequest::route('/{record}/edit'),
        ];
    }
}