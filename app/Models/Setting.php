<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Fonction statique pour récupérer une valeur rapidement
     * Utilisation : Setting::value('site_phone')
     */
    public static function value($key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        // Auto-cast selon le type
        return match ($setting->type) {
            'json' => json_decode($setting->value, true),
            'array' => explode(',', $setting->value),
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $setting->value,
            'float' => (float) $setting->value,
            default => $setting->value,
        };
    }

    /**
     * Scope : Récupérer les settings d'un groupe
     */
    public function scopeInGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
