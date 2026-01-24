<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si une langue est stockée en session, on l'utilise
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Sinon par défaut : Français
            App::setLocale('fr');
        }

        return $next($request);
    }
}