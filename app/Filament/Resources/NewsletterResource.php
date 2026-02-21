<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterResource\Pages;
use App\Models\Newsletter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Newsletters';
    protected static ?string $navigationGroup = 'Communication';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Rédacteur')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Auteur')
                            ->relationship('author', 'name')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Contenu')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Contenu')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('État')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options([
                                'draft' => 'Brouillon',
                                'sent' => 'Envoyé',
                            ])
                            ->required()
                            ->disabled(fn (string $operation) => $operation === 'edit'),

                        Forms\Components\DateTimePicker::make('sent_at')
                            ->label('Envoyé le')
                            ->readonly(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->weight('bold')
                    ->limit(50),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Auteur'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'warning',
                        'sent' => 'success',
                    }),

                Tables\Columns\TextColumn::make('sent_at')
                    ->label('Envoyé le')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Brouillons',
                        'sent' => 'Envoyés',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Newsletter $record) => $record->status === 'draft'),

                // Action pour envoyer la newsletter
                Tables\Actions\Action::make('send')
                    ->label('Envoyer')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->visible(fn (Newsletter $record) => $record->status === 'draft')
                    ->requiresConfirmation()
                    ->action(function (Newsletter $record) {
                        // Récupérer tous les abonnés confirmés
                        $subscribers = \App\Models\NewsletterSubscriber::active()->get();

                        if ($subscribers->isEmpty()) {
                            \Filament\Notifications\Notification::make()
                                ->title('Aucun abonné')
                                ->body('Il n\'y a aucun abonné confirmé pour recevoir cette newsletter.')
                                ->warning()
                                ->send();

                            return;
                        }

                        // Envoyer le newsletter à chaque abonné
                        $count = 0;
                        foreach ($subscribers as $subscriber) {
                            \Illuminate\Support\Facades\Mail::to($subscriber->email)
                                ->queue(new \App\Mail\NewsletterMail($record, $subscriber));
                            $count++;
                        }

                        $record->update([
                            'status' => 'sent',
                            'sent_at' => now(),
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Newsletter envoyée avec succès')
                            ->body('La newsletter a été mise en queue pour envoi à ' . $count . ' abonné(s)')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn (Newsletter $record) => $record->status === 'draft'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletters::route('/'),
            'create' => Pages\CreateNewsletter::route('/create'),
            'edit' => Pages\EditNewsletter::route('/{record}/edit'),
        ];
    }
}
