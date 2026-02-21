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
        // 1. Créer l'Admin (utilisateur principal)
        $this->command->info('Création de l\'utilisateur administrateur...');
        User::firstOrCreate(
            ['email' => 'admin@ckevent.com'],
            [
                'name' => 'Cynthia Kenne',
                'password' => bcrypt('cynthia@123'),
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );

        // 2. Paramètres Généraux
        $this->command->info('Configuration des paramètres généraux...');
        $this->call(SettingsSeeder::class);

        // 3. Catégories (Articles/Blog)
        $this->command->info('Création des catégories d\'articles...');
        $this->call(CategorySeeder::class);

        // 4. Types d'Événements (Portfolio)
        $this->command->info('Création des types d\'événements...');
        $this->call(EventTypeSeeder::class);

        // 5. Parcours de Cynthia
        $this->command->info('Création du parcours de Cynthia...');
        $this->call(JourneySeeder::class);

        // 6. Pages Statiques
        $this->command->info('Création des pages statiques...');
        $this->call(PageSeeder::class);

        // 7. OPTIONNEL : Générer la masse de données
        // Décommenter les lignes ci-dessous pour générer des données de test
        //$this->command->info('Génération de 05 Articles (avec images)...');
        //Article::factory(05)->create();

        //$this->command->info('Génération de 05 Événements (avec galeries)...');
        //Event::factory(05)->create();

        //$this->command->info('Génération de 05 Témoignages...');
        //Testimonial::factory(05)->create();

        //$this->command->info('Création des Partenaires...');
        //$this->call(PartnerSeeder::class);

        $this->command->info('✓ Base de données seedée avec succès !');
    }
}
