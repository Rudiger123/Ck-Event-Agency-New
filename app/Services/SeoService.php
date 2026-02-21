<?php

namespace App\Services;

use Illuminate\Support\Facades\View;

class SeoService
{
    private array $meta = [];
    private array $og = [];
    private ?string $schema = null;

    /**
     * Définir les méta tags
     */
    public function setMeta(array $data): self
    {
        $this->meta = array_merge($this->meta, $data);
        return $this;
    }

    /**
     * Définir les Open Graph tags
     */
    public function setOpenGraph(array $data): self
    {
        $this->og = array_merge($this->og, $data);
        return $this;
    }

    /**
     * Définir le schema JSON-LD
     */
    public function setSchema(string $schema): self
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * Rendre les meta tags dans le head
     */
    public function render(): string
    {
        $html = '';

        // Meta tags standard
        if (isset($this->meta['title'])) {
            $html .= '<title>' . htmlspecialchars($this->meta['title']) . '</title>' . PHP_EOL;
        }

        if (isset($this->meta['description'])) {
            $html .= '<meta name="description" content="' . htmlspecialchars($this->meta['description']) . '">' . PHP_EOL;
        }

        if (isset($this->meta['keywords'])) {
            $html .= '<meta name="keywords" content="' . htmlspecialchars($this->meta['keywords']) . '">' . PHP_EOL;
        }

        // Open Graph tags
        if (isset($this->og['title'])) {
            $html .= '<meta property="og:title" content="' . htmlspecialchars($this->og['title']) . '">' . PHP_EOL;
        }

        if (isset($this->og['description'])) {
            $html .= '<meta property="og:description" content="' . htmlspecialchars($this->og['description']) . '">' . PHP_EOL;
        }

        if (isset($this->og['type'])) {
            $html .= '<meta property="og:type" content="' . htmlspecialchars($this->og['type']) . '">' . PHP_EOL;
        }

        if (isset($this->og['url'])) {
            $html .= '<meta property="og:url" content="' . htmlspecialchars($this->og['url']) . '">' . PHP_EOL;
        }

        if (isset($this->og['image'])) {
            $html .= '<meta property="og:image" content="' . htmlspecialchars($this->og['image']) . '">' . PHP_EOL;
        }

        // Twitter Card
        if (isset($this->og['title'])) {
            $html .= '<meta name="twitter:title" content="' . htmlspecialchars($this->og['title']) . '">' . PHP_EOL;
        }

        if (isset($this->og['description'])) {
            $html .= '<meta name="twitter:description" content="' . htmlspecialchars($this->og['description']) . '">' . PHP_EOL;
        }

        if (isset($this->og['image'])) {
            $html .= '<meta name="twitter:image" content="' . htmlspecialchars($this->og['image']) . '">' . PHP_EOL;
        }

        // Canonical URL
        if (isset($this->meta['canonical'])) {
            $html .= '<link rel="canonical" href="' . htmlspecialchars($this->meta['canonical']) . '">' . PHP_EOL;
        }

        // JSON-LD Schema
        if ($this->schema) {
            $html .= '<script type="application/ld+json">' . PHP_EOL;
            $html .= $this->schema;
            $html .= PHP_EOL . '</script>' . PHP_EOL;
        }

        return $html;
    }

    /**
     * Helper statique pour accès facile
     */
    public static function for(): self
    {
        return app(self::class);
    }
}
