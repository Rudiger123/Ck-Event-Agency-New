<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use SoftDeletes, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'event_type_id',
        'title',
        'slug',
        'description',
        'event_date',
        'location',
        'client_name',
        'testimonial',
        'status',
        'is_featured',
        'order',
        'meta_title',
        'meta_description',
    ];

    public $translatable = [
        'title', 
        'description', 
        'testimonial', 
        'meta_title', 
        'meta_description'
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover_image')->singleFile();
        $this->addMediaCollection('gallery'); // Plusieurs images possibles
    }
}