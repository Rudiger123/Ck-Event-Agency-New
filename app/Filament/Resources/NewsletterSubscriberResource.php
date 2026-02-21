<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Abonnés Newsletter';
    protected static ?string $navigationGroup = 'Communication';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::active()->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Adresse Email')
                            ->email()
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Select::make('locale')
                            ->label('Langue')
                            ->options([
                                'fr' => 'Français',
                                'en' => 'English',
                            ])
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(2),

                Forms\Components\Section::make('Statut')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente de confirmation',
                                'confirmed' => 'Confirmé',
                                'unsubscribed' => 'Désabonné',
                            ])
                            ->required(),

                        Forms\Components\DateTimePicker::make('confirmed_at')
                            ->label('Confirmé le')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\DateTimePicker::make('unsubscribed_at')
                            ->label('Désabonné le')
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(2),

                Forms\Components\Section::make('Dates')
                    ->schema([
                        Forms\Components\TextInput::make('created_at')
                            ->label('Inscrit le')
                            ->disabled()
                            ->dehydrated(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('locale')
                    ->label('Langue')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fr' => 'info',
                        'en' => 'primary',
                    }),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Actif')
                    ->getStateUsing(fn (NewsletterSubscriber $record): bool => $record->status === 'confirmed')
                    ->updateStateUsing(function (NewsletterSubscriber $record, bool $state): void {
                        $record->update([
                            'status' => $state ? 'confirmed' : 'unsubscribed',
                            'confirmed_at' => $state ? now() : null,
                            'unsubscribed_at' => !$state ? now() : null,
                        ]);
                    })
                    ->action(function () {
                        return;
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'unsubscribed' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Inscrit le')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'En attente',
                        'confirmed' => 'Confirmés',
                        'unsubscribed' => 'Désabonnés',
                    ]),

                Tables\Filters\SelectFilter::make('locale')
                    ->options([
                        'fr' => 'Français',
                        'en' => 'English',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\Section::make('Modifier le statut')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Statut')
                                    ->options([
                                        'pending' => 'En attente de confirmation',
                                        'confirmed' => 'Confirmé',
                                        'unsubscribed' => 'Désabonné',
                                    ])
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (Forms\Set $set, string $state) {
                                        if ($state === 'confirmed') {
                                            $set('confirmed_at', now());
                                            $set('unsubscribed_at', null);
                                        } elseif ($state === 'unsubscribed') {
                                            $set('unsubscribed_at', now());
                                            $set('confirmed_at', null);
                                        }
                                    }),

                                Forms\Components\DateTimePicker::make('confirmed_at')
                                    ->label('Confirmé le')
                                    ->disabled(),

                                Forms\Components\DateTimePicker::make('unsubscribed_at')
                                    ->label('Désabonné le')
                                    ->disabled(),
                            ]),
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('confirm')
                        ->label('Confirmer')
                        ->icon('heroicon-m-check')
                        ->action(fn (Collection $records) => $records->each(fn (NewsletterSubscriber $record) => $record->update([
                            'status' => 'confirmed',
                            'confirmed_at' => now(),
                            'unsubscribed_at' => null,
                        ])))
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('unsubscribe')
                        ->label('Désabonner')
                        ->icon('heroicon-m-x-mark')
                        ->action(fn (Collection $records) => $records->each(fn (NewsletterSubscriber $record) => $record->update([
                            'status' => 'unsubscribed',
                            'unsubscribed_at' => now(),
                            'confirmed_at' => null,
                        ])))
                        ->requiresConfirmation(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletterSubscribers::route('/'),
            'edit' => Pages\EditNewsletterSubscriber::route('/{record}/edit'),
            'view' => Pages\ViewNewsletterSubscriber::route('/{record}'),
        ];
    }

    /**
     * Retirer les actions de création
     */
    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * Retirer les actions de suppression
     */
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
