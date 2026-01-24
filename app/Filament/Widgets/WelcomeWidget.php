<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class WelcomeWidget extends Widget
{
    protected static string $view = 'filament.widgets.welcome-widget';
    protected static ?int $sort = 1;
    
    // On veut que ce widget prenne toute la largeur
    protected int | string | array $columnSpan = 'full';

    // On passe le nom de l'utilisateur à la vue
    protected function getViewData(): array
    {
        return [
            'user' => Auth::user(),
        ];
    }
}