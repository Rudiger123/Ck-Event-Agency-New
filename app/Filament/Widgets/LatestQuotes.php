<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\QuoteRequest;

class LatestQuotes extends BaseWidget
{
    protected static ?int $sort = 4; // Tout en bas
    protected int | string | array $columnSpan = 'full'; // Toute la largeur
    protected static ?string $heading = 'Dernières demandes de devis';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // On prend les 5 derniers devis
                QuoteRequest::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Client')
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('budget')
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'processing' => 'info',
                        'completed' => 'success',
                        'archived' => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Date')
                    ->since(),
            ])
            ->actions([
                // Petit bouton pour voir le devis directement
                Tables\Actions\Action::make('open')
                    ->url(fn (QuoteRequest $record): string => route('filament.admin.resources.quote-requests.edit', $record))
                    ->icon('heroicon-m-eye')
                    ->label('Voir'),
            ]);
    }
}