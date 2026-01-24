<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EventType extends Model
{
    use HasTranslations;

    // C'est cette ligne qui manquait et causait l'erreur
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'order',
        'is_active',
    ];

    public $translatable = ['name'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}