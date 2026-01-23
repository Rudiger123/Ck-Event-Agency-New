<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use SoftDeletes, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'status',
        'is_featured',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    // Définir quelles colonnes sont traduisibles (JSON)
    public $translatable = [
        'title', 
        'excerpt', 
        'content', 
        'meta_title', 
        'meta_description', 
        'meta_keywords'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Configuration des Images (Une à la une, Vidéo, Audio)
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile(); // Une seule image à la une

        $this->addMediaCollection('video')
            ->singleFile(); // Une seule vidéo principale

        $this->addMediaCollection('audio')
            ->singleFile(); // Un seul fichier audio
    }
}