<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Title;

class ArticleList extends Component
{
    use WithPagination; // Pour avoir les pages 1, 2, 3...

    public $search = '';
    public $category_id = '';

    #[Title('Actualités & Presse')]
    public function render()
    {
        $query = Article::query()
            ->where('status', 'published')
            ->latest('published_at');

        // Filtre par Recherche
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        // Filtre par Catégorie
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        return view('livewire.blog.article-list', [
            'articles' => $query->paginate(9), // 9 articles par page
            'categories' => Category::where('is_active', true)->get()
        ]);
    }

    // Réinitialiser la pagination si on cherche quelque chose
    public function updatedSearch()
    {
        $this->resetPage();
    }
}