<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Message;
use App\Models\QuoteRequest;
use App\Models\Article;

class StatsOverview extends BaseWidget
{
    // On demande à ce widget de se rafraîchir toutes les 15 secondes (Optionnel)
    protected static ?string $pollingInterval = '15s';

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        // 1. Calculer les messages non lus
        $unreadMessages = Message::where('status', 'unread')->count();
        
        // 2. Calculer les devis "Nouveaux"
        $newQuotes = QuoteRequest::where('status', 'new')->count();
        
        // 3. Calculer les vues totales des articles (si tu as la colonne views_count)
        $totalViews = Article::sum('views_count');

        return [
            Stat::make('Messages Non Lus', $unreadMessages)
                ->description($unreadMessages > 0 ? 'À traiter rapidement' : 'Tout est à jour')
                ->descriptionIcon($unreadMessages > 0 ? 'heroicon-m-envelope' : 'heroicon-m-check-circle')
                ->color($unreadMessages > 0 ? 'danger' : 'success')
                ->chart($unreadMessages > 0 ? [7, 2, 10, 3, 15, 4, 17] : null), // Petit graphique déco

            Stat::make('Demandes de Devis', $newQuotes)
                ->description('Nouvelles opportunités')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning') // Couleur Dorée (Amber)
                ->chart([15, 4, 10, 2, 12, 4, 12]),

            Stat::make('Audience Blog', number_format($totalViews))
                ->description('Vues totales des articles')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
        ];
    }
}