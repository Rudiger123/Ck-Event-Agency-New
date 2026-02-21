<?php

namespace Database\Seeders;

use App\Models\Journey;
use Illuminate\Database\Seeder;

class JourneySeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            [
                'year' => '2018',
                'title' => 'Académie & Linguistique',
                'description' => "Obtention du Baccalauréat A4 All au Lycée Bilingue de Dschang et début des études trilingues en allemand à l'Université de Dschang, sous l'influence de la rigueur académique familiale.",
                'icon' => 'academic-cap',
                'order' => 1,
            ],
            [
                'year' => '2021',
                'title' => 'L’éveil médiatique',
                'description' => "Entrée concrète dans le monde des médias via un stage à la radio Nkwalah 100.0 FM. Passionnée et rigoureuse, je suis rapidement intégrée comme journaliste radio permanente.",
                'icon' => 'microphone',
                'order' => 2,
            ],
            [
                'year' => '2023',
                'title' => 'Rédactrice en Chef',
                'description' => "Promotion au poste de Rédactrice en Chef de la radio Nkwalah. Pendant 15 mois, j'ai assuré la coordination éditoriale, l'encadrement de l'équipe et la qualité des contenus diffusés.",
                'icon' => 'briefcase',
                'order' => 3,
            ],
            [
                'year' => '2024',
                'title' => 'Consécration Académique',
                'description' => "Soutenance avec succès du Master II en Sciences de l'Information et de la Communication à l'Université de Dschang. Note : 17/20, Mention Très Bien.",
                'icon' => 'trophy',
                'order' => 4,
            ],
            [
                'year' => '2025',
                'title' => 'CK Agency & Engagement',
                'description' => "Lancement de CK Agency (Communication & Knowledge) et engagement au service communication de l'association TOCKEM pour porter des projets à fort impact social.",
                'icon' => 'star',
                'order' => 5,
            ],
        ];

        foreach ($steps as $step) {
            Journey::updateOrCreate(
                ['year' => $step['year'], 'title' => $step['title']],
                [
                    'description' => $step['description'],
                    'icon' => $step['icon'],
                    'order' => $step['order'],
                ]
            );
        }
    }
}
