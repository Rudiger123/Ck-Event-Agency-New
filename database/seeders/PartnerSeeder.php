<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => ['fr' => 'France Médias', 'en' => 'France Media'],
                'slug' => 'france-medias',
                'description' => ['fr' => 'Leader français de la production audiovisuelle', 'en' => 'Leading French audiovisual production company'],
                'website_url' => 'https://francemedia.fr',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => ['fr' => 'TV Report', 'en' => 'TV Report'],
                'slug' => 'tv-report',
                'description' => ['fr' => 'Agence de reportage télévisé', 'en' => 'Television reporting agency'],
                'website_url' => 'https://tvreport.fr',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => ['fr' => 'Presse d\'Or', 'en' => 'Gold Press'],
                'slug' => 'presse-dor',
                'description' => ['fr' => 'Groupe de presse premium', 'en' => 'Premium press group'],
                'website_url' => 'https://pressedor.fr',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => ['fr' => 'Event Masters', 'en' => 'Event Masters'],
                'slug' => 'event-masters',
                'description' => ['fr' => 'Spécialiste événementiel international', 'en' => 'International event specialist'],
                'website_url' => 'https://eventmasters.com',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => ['fr' => 'Communication Plus', 'en' => 'Communication Plus'],
                'slug' => 'communication-plus',
                'description' => ['fr' => 'Agence de communication holistique', 'en' => 'Holistic communication agency'],
                'website_url' => 'https://communiplus.com',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => ['fr' => 'L\'Éloquence', 'en' => 'The Eloquence'],
                'slug' => 'eloquence',
                'description' => ['fr' => 'Cabinet de relations presse', 'en' => 'Press relations cabinet'],
                'website_url' => 'https://eloquence.fr',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
