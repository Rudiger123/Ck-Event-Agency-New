<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    public function run(): void
    {
        $eventTypes = [
            [
                'name' => 'Mariage',
                'slug' => 'mariage',
                'icon' => 'heart',
                'color' => '#E91E63',
                'order' => 1,
            ],
            [
                'name' => 'Gala & Soirées VIP',
                'slug' => 'gala-soirees-vip',
                'icon' => 'diamond',
                'color' => '#C9A961',
                'order' => 2,
            ],
            [
                'name' => 'Événement Corporatif',
                'slug' => 'evenement-corporatif',
                'icon' => 'briefcase',
                'color' => '#2C3E50',
                'order' => 3,
            ],
            [
                'name' => 'Cérémonie Officielle',
                'slug' => 'ceremonie-officielle',
                'icon' => 'crown',
                'color' => '#D4AF37',
                'order' => 4,
            ],
            [
                'name' => 'Lancement de Produit',
                'slug' => 'lancement-produit',
                'icon' => 'rocket',
                'color' => '#FF6B6B',
                'order' => 5,
            ],
            [
                'name' => 'Conférence & Séminaire',
                'slug' => 'conference-seminaire',
                'icon' => 'mic',
                'color' => '#4ECDC4',
                'order' => 6,
            ],
            [
                'name' => 'Anniversaire & Célébration',
                'slug' => 'anniversaire-celebration',
                'icon' => 'cake',
                'color' => '#FFD93D',
                'order' => 7,
            ],
            [
                'name' => 'Événement Communautaire',
                'slug' => 'evenement-communautaire',
                'icon' => 'users',
                'color' => '#6BCB77',
                'order' => 8,
            ],
            [
                'name' => 'Festival & Grand Public',
                'slug' => 'festival-grand-public',
                'icon' => 'star',
                'color' => '#FF006E',
                'order' => 9,
            ],
            [
                'name' => 'Formation & Atelier',
                'slug' => 'formation-atelier',
                'icon' => 'pencil',
                'color' => '#8366C4',
                'order' => 10,
            ],
        ];

        foreach ($eventTypes as $typeData) {
            EventType::updateOrCreate(
                ['slug' => $typeData['slug']],
                [
                    'name' => ['fr' => $typeData['name']],
                    'icon' => $typeData['icon'],
                    'color' => $typeData['color'],
                    'order' => $typeData['order'],
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('✓ Types d\'événements créés avec succès');
    }
}
