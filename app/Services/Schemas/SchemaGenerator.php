<?php

namespace App\Services\Schemas;

use Illuminate\Support\Facades\URL;

class SchemaGenerator
{
    /**
     * Générer le schema Organization pour la homepage
     */
    public static function organization(): string
    {
        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => config('app.name'),
            "description" => "Agence de presse et d'imprésariat de luxe",
            "url" => config('app.url'),
            "logo" => asset('images/logo.png'),
            "image" => asset('images/hero.png'),
            "telephone" => config('app.phone', ''),
            "email" => config('app.email', ''),
            "foundingDate" => config('app.founding_date', '2020'),
            "sameAs" => [
                config('app.social.facebook', ''),
                config('app.social.instagram', ''),
                config('app.social.linkedin', ''),
                config('app.social.twitter', ''),
            ],
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => config('app.address.street', ''),
                "addressLocality" => config('app.address.city', ''),
                "postalCode" => config('app.address.postal_code', ''),
                "addressCountry" => config('app.address.country', 'FR'),
            ],
            "contactPoint" => [
                "@type" => "ContactPoint",
                "contactType" => "Customer Service",
                "telephone" => config('app.phone', ''),
                "email" => config('app.email', ''),
            ],
            "areaServed" => [
                "FR",
                "BE",
                "LU",
                "CH",
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Générer le schema NewsArticle pour les articles
     */
    public static function newsArticle($article): string
    {
        $imageUrl = null;
        if ($article->hasMedia('featured')) {
            $imageUrl = $article->getFirstMediaUrl('featured');
        }

        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "NewsArticle",
            "headline" => $article->meta_title ?? $article->title,
            "description" => $article->meta_description ?? $article->excerpt,
            "image" => $imageUrl ?? asset('images/article-default.png'),
            "datePublished" => $article->published_at?->toIso8601String(),
            "dateModified" => $article->updated_at->toIso8601String(),
            "author" => [
                "@type" => "Person",
                "name" => "Cynthia Kenne",
                "url" => config('app.url'),
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => config('app.name'),
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset('images/logo.png'),
                ],
            ],
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => route('blog.show', $article->slug),
            ],
            "keywords" => $article->meta_keywords ?? '',
            "articleBody" => strip_tags($article->content),
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Générer le schema Event pour les événements
     */
    public static function event($event): string
    {
        $imageUrl = null;
        if ($event->hasMedia('featured')) {
            $imageUrl = $event->getFirstMediaUrl('featured');
        }

        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "Event",
            "name" => $event->title,
            "description" => $event->meta_description ?? $event->description,
            "image" => $imageUrl ?? asset('images/event-default.png'),
            "startDate" => $event->event_date?->toIso8601String(),
            "location" => [
                "@type" => "Place",
                "name" => $event->location,
                "address" => [
                    "@type" => "PostalAddress",
                    "addressLocality" => $event->location,
                    "addressCountry" => "FR",
                ],
            ],
            "organizer" => [
                "@type" => "Organization",
                "name" => config('app.name'),
                "url" => config('app.url'),
                "logo" => asset('images/logo.png'),
            ],
            "eventType" => $event->eventType?->name ?? "Event",
            "eventStatus" => "EventScheduled",
            "url" => route('portfolio.show', $event->slug),
            "keywords" => $event->eventType?->name ?? '',
            "about" => strip_tags($event->description),
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Générer le schema BreadcrumbList
     */
    public static function breadcrumb(array $items): string
    {
        $itemListElement = [];
        foreach ($items as $index => $item) {
            $itemListElement[] = [
                "@type" => "ListItem",
                "position" => $index + 1,
                "name" => $item['name'],
                "item" => $item['url'],
            ];
        }

        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $itemListElement,
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
