<?php

if (!function_exists('seo')) {
    /**
     * Accéder au service SEO globalement
     */
    function seo(): \App\Services\SeoService
    {
        return app(\App\Services\SeoService::class);
    }
}

if (!function_exists('renderSeoHead')) {
    /**
     * Rendre les meta tags SEO dans le head
     */
    function renderSeoHead(): string
    {
        return seo()->render();
    }
}

if (!function_exists('setSeoMeta')) {
    /**
     * Définir les meta SEO rapidement
     */
    function setSeoMeta(array $data): \App\Services\SeoService
    {
        return seo()->setMeta($data);
    }
}
