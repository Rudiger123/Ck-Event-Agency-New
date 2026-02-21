<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Génère un slug unique basé sur le titre
     */
    public static function bootSluggable(): void
    {
        static::creating(function ($model) {
            $model->generateSlug();
        });

        static::updating(function ($model) {
            // Régénérer le slug si le titre a changé et le slug est vide
            if ($model->isDirty('title') && empty($model->slug)) {
                $model->generateSlug();
            }
        });
    }

    /**
     * Génère le slug unique
     */
    public function generateSlug(): void
    {
        $titleField = $this->getSlugSource() ?? 'title';
        $title = $this->$titleField;

        // Si c'est un champ translatable, on prend la version actuelle
        if (property_exists($this, 'translatable') && in_array($titleField, $this->translatable)) {
            $title = $this->getAttributeValue($titleField);
        }

        if (!empty($title)) {
            $slug = Str::slug($title);
            $this->slug = $this->makeSlugUnique($slug);
        }
    }

    /**
     * Rend le slug unique en ajoutant un suffixe si nécessaire
     */
    protected function makeSlugUnique($slug): string
    {
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
            ->where('id', '<>', $this->id ?? 0)
            ->exists()) {
            $slug = $originalSlug . '-' . $counter++;  // ✅ Concaténation avec . et incrémentation
        }

        return $slug;
    }

    /**
     * Permet de personnaliser le champ source du slug (override cette méthode si nécessaire)
     */
    protected function getSlugSource(): string
    {
        return 'title';
    }
}
