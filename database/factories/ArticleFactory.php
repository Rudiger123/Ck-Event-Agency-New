<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;

class ArticleFactory extends Factory
{
    
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            // On génère du contenu en JSON pour le multilingue (FR)
            'title' => ['fr' => fake()->sentence(6)],
            'slug' => fake()->slug(),
            'excerpt' => ['fr' => fake()->paragraph()],
            'content' => ['fr' => fake()->paragraphs(5, true)], // 5 paragraphes HTML
            
            // On lie à un utilisateur existant (le premier trouvé) ou on en crée un
            'user_id' => User::first()->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            
            'status' => 'published',
            'is_featured' => fake()->boolean(20), // 20% de chance d'être à la une
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'views_count' => fake()->numberBetween(10, 5000),
        ];
    }

    // Cette fonction s'exécute APRÈS la création de l'article pour ajouter l'image
    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            try {
                // On récupère une image aléatoire (Tech/Business)
                $imageUrl = 'https://picsum.photos/800/600?random=' . rand(1, 1000);
                
                $article->addMediaFromUrl($imageUrl)
                        ->toMediaCollection('featured_image');
            } catch (\Exception $e) {
                // Si l'image échoue (problème internet), on continue sans planter
            }
        });
    }
}