<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'role',
        'content',
        'rating',
        'is_active',
        'order',
    ];

    // Colonnes traduisibles
    public $translatable = [
        'name',
        'role',
        'content',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    /**
     * Scope : Récupérer les témoignages actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
