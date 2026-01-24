<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Message;
use App\Models\QuoteRequest;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Activité Récente';
    protected static ?int $sort = 3; // Position après les stats
    protected int | string | array $columnSpan = 'full'; // Prend toute la largeur
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Données des Messages (7 derniers jours)
        $messagesData = Trend::model(Message::class)
            ->between(start: now()->subDays(7), end: now())
            ->perDay()
            ->count();

        // Données des Devis (7 derniers jours)
        $quotesData = Trend::model(QuoteRequest::class)
            ->between(start: now()->subDays(7), end: now())
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Messages reçus',
                    'data' => $messagesData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#9CA3AF', // Gris
                    'backgroundColor' => 'rgba(156, 163, 175, 0.1)',
                    'fill' => true,
                ],
                [
                    'label' => 'Demandes de Devis',
                    'data' => $quotesData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#F59E0B', // Ambre/Or
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $messagesData->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Type de graphique : Ligne
    }
}