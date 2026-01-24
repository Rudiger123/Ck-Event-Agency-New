<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    protected $fillable = ['article_id', 'name', 'email', 'content', 'is_visible'];
    
    public function article() {
        return $this->belongsTo(Article::class);
    }
}