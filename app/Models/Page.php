<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Sluggable;

class Page extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, Sluggable;

    protected $fillable = [
        'key',
        'title',
        'slug',
        'content',
        'excerpt',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    public $translatable = [
        'title',
        'content',
        'excerpt',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Collections média
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_image')->singleFile();
    }

    /**
     * Scope : Récupérer les pages actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
