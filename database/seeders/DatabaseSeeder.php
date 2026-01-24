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
                'password' => bcrypt('password'),
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
        //$this->command->info('Génération de 25 Articles (avec images)...');
        //Article::factory(25)->create();

        //$this->command->info('Génération de 15 Événements (avec galeries)...');
        //Event::factory(15)->create();

        $this->command->info('Génération de 10 Témoignages...');
        Testimonial::factory(10)->create();
    }
}