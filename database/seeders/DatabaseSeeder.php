<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\EventType;
use App\Models\Article;
use App\Models\Event;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer l'Admin (si pas déjà fait)
        User::firstOrCreate(
            ['email' => 'admin@ckevent.com'],
            [
                'name' => 'Cynthia Kenne',
                'password' => bcrypt('cynthia@123'),
                'role' => 'super_admin',
            ]
        );

        // 2. Créer des Catégories (Articles)
        $categories = ['Presse & Média', 'Événementiel', 'Lifestyle', 'Culture', 'Actualité Agence'];
        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($cat)],
                ['name' => ['fr' => $cat], 'is_active' => true]
            );
        }

        // 3. Créer des Types d'Événements (Portfolio)
        $types = ['Mariage', 'Anniversaire', 'Corporatif', 'Cérémonie Officielle'];
        foreach ($types as $type) {
            EventType::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($type)],
                ['name' => ['fr' => $type], 'color' => '#C9A961']
            );
        }

        // 4. GÉNÉRER LA MASSE DE DONNÉES
        //$this->command->info('Génération de 05 Articles (avec images)...');
        //Article::factory(05)->create();

        //$this->command->info('Génération de 05 Événements (avec galeries)...');
        //Event::factory(05)->create();

        //$this->command->info('Génération de 05 Témoignages...');
        //Testimonial::factory(05)->create();

        // 5. SEEDER LES PARTENAIRES
        //$this->command->info('Création des Partenaires...');
        //$this->call(PartnerSeeder::class);
        // 6. SEEDER LES JOURNEYS
        
        $this->command->info('Création du parcours de Cynthia...');
        $this->call(JourneySeeder::class);
        // 7. SEEDER LES PAGES
        $this->command->info('Création des Pages statiques...');
        $this->call([
            PageSeeder::class,
        ]);
    }
}
