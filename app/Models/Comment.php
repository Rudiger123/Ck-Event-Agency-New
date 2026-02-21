<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'name',
        'email',
        'content',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation : L'article auquel appartient le commentaire
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Scope : Récupérer les commentaires visibles
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
