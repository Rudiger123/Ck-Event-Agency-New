<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Actualités Agence',
                'slug' => 'actualites-agence',
                'description' => 'Découvrez les dernières nouvelles, projets et initiatives de CK Agency.',
                'order' => 1,
            ],
            [
                'name' => 'Média & Presse',
                'slug' => 'media-presse',
                'description' => 'Articles, reportages et interviews liés aux médias et à la presse.',
                'order' => 2,
            ],
            [
                'name' => 'Événementiel',
                'slug' => 'evenementiel',
                'description' => 'Conseils, tendances et retours d\'expérience sur la gestion d\'événements.',
                'order' => 3,
            ],
            [
                'name' => 'Communication',
                'slug' => 'communication',
                'description' => 'Stratégies et bonnes pratiques en matière de communication et marketing.',
                'order' => 4,
            ],
            [
                'name' => 'Inspiration & Culture',
                'slug' => 'inspiration-culture',
                'description' => 'Partage culturel, pensées inspirantes et réflexions de notre directrice.',
                'order' => 5,
            ],
            [
                'name' => 'Coulisses & Récits',
                'slug' => 'coulisses-recits',
                'description' => 'Histoires captivantes et coulisses des événements que nous organisons.',
                'order' => 6,
            ],
            [
                'name' => 'Partenaires',
                'slug' => 'partenaires',
                'description' => 'Mise en avant de nos collaborateurs et partenaires de confiance.',
                'order' => 7,
            ],
            [
                'name' => 'Ressources & Conseils',
                'slug' => 'ressources-conseils',
                'description' => 'Guides pratiques, astuces et ressources utiles pour vos projets.',
                'order' => 8,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => ['fr' => $categoryData['name']],
                    'description' => ['fr' => $categoryData['description']],
                    'is_active' => true,
                    'order' => $categoryData['order'],
                ]
            );
        }

        $this->command->info('✓ Catégories d\'articles créées avec succès');
    }
}
