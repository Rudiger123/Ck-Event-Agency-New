<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use App\Models\Article;
use App\Models\Comment;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class ArticleDetail extends Component
{
    public Article $article;
    public $hasLiked = false;

    // Pour le formulaire de commentaire
    #[Validate('required|min:3')]
    public $commentName = '';

    #[Validate('required|email')]
    public $commentEmail = '';

    #[Validate('required|min:5')]
    public $commentContent = '';

    public $commentSuccess = false;

    public function mount($slug)
    {
        $this->article = Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        // Incrémenter les vues
        $this->article->increment('views_count');

        // Vérifier si l'utilisateur a déjà liké (via Session)
        $this->hasLiked = Session::has('liked_article_' . $this->article->id);
    }

    public function toggleLike()
    {
        if ($this->hasLiked) {
            return; // On ne peut pas "un-liker" pour simplifier, ou tu peux le coder si tu veux
        }

        $this->article->increment('likes');
        Session::put('liked_article_' . $this->article->id, true);
        $this->hasLiked = true;
    }

    public function submitComment()
    {
        $this->validate();

        Comment::create([
            'article_id' => $this->article->id,
            'name' => $this->commentName,
            'email' => $this->commentEmail,
            'content' => $this->commentContent,
            'is_visible' => false, // En attente de modération
        ]);

        $this->reset(['commentName', 'commentEmail', 'commentContent']);
        $this->commentSuccess = true;
    }

    public function render()
    {
        // Récupérer les commentaires validés
        $comments = $this->article->comments()->latest()->get();

        // (Code SEO existant...)
        $seoTitle = $this->article->meta_title ?: $this->article->title;
        $seoDesc = $this->article->meta_description ?: $this->article->excerpt;
        $seoImage = $this->article->getFirstMediaUrl('featured_image');

        return view('livewire.blog.article-detail', [
            'comments' => $comments
        ])->layout('components.layouts.app', [
            'title' => $seoTitle,
            'description' => $seoDesc,
            'image' => $seoImage,
        ]);
    }
}