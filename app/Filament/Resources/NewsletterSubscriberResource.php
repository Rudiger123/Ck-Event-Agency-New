<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom'),

                        Forms\Components\Select::make('locale')
                            ->label('Langue')
                            ->options([
                                'fr' => 'Français',
                                'en' => 'English',
                            ])
                            ->default('fr')
                            ->required(),
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
                            ->label('Confirmé le'),

                        Forms\Components\DateTimePicker::make('unsubscribed_at')
                            ->label('Désabonné le'),
                    ])->columns(2),
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

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'unsubscribed' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('confirmed_at')
                    ->label('Confirmé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListNewsletterSubscribers::route('/'),
            'edit' => Pages\EditNewsletterSubscriber::route('/{record}/edit'),
        ];
    }
}
