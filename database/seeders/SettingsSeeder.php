<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Informations Générales
            [
                'key' => 'site_name',
                'value' => 'CK Agency',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Communication & Knowledge',
                'type' => 'text',
                'group' => 'general',
            ],
            [
                'key' => 'site_description',
                'value' => 'CK Agency : Expertise en communication, événementiel et presse. Nous donnons du sens à votre message.',
                'type' => 'textarea',
                'group' => 'general',
            ],
            [
                'key' => 'site_logo_dark',
                'value' => '/images/logo-dark.png',
                'type' => 'image',
                'group' => 'general',
            ],
            [
                'key' => 'site_logo_light',
                'value' => '/images/logo-light.png',
                'type' => 'image',
                'group' => 'general',
            ],
            [
                'key' => 'site_favicon',
                'value' => '/images/favicon.ico',
                'type' => 'image',
                'group' => 'general',
            ],

            // Informations de Contact
            [
                'key' => 'contact_email',
                'value' => 'cynthiankwete@gmail.com',
                'type' => 'email',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+237 654 81 12 69',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone_alt',
                'value' => '+237 654 81 12 69',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_location',
                'value' => 'Dschang, Région de la Menoua, Cameroun',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Dschang, Cameroun',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_timezone',
                'value' => 'Africa/Douala',
                'type' => 'text',
                'group' => 'contact',
            ],

            // Réseaux Sociaux
            [
                'key' => 'social_facebook',
                'value' => 'https://www.facebook.com/cynthia.kenne.9',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_facebook_page',
                'value' => 'https://www.facebook.com/ckagency',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_instagram',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_linkedin',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_youtube',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
            ],
            [
                'key' => 'social_twitter',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
            ],

            // Propriétaire/Directeur
            [
                'key' => 'owner_name',
                'value' => 'Cynthia Kenne',
                'type' => 'text',
                'group' => 'owner',
            ],
            [
                'key' => 'owner_title',
                'value' => 'Directrice & Fondatrice',
                'type' => 'text',
                'group' => 'owner',
            ],
            [
                'key' => 'owner_bio',
                'value' => 'Master II en Sciences de l\'Information et de la Communication (2024).
Spécialiste en communication événementielle et gestion de l\'information.',
                'type' => 'textarea',
                'group' => 'owner',
            ],
            [
                'key' => 'owner_email',
                'value' => 'cynthiankwete@gmail.com',
                'type' => 'email',
                'group' => 'owner',
            ],
            [
                'key' => 'owner_phone',
                'value' => '+237 654 81 12 69',
                'type' => 'text',
                'group' => 'owner',
            ],
            [
                'key' => 'owner_facebook',
                'value' => 'https://www.facebook.com/cynthia.kenne.9',
                'type' => 'url',
                'group' => 'owner',
            ],

            // Configuration Email
            [
                'key' => 'mail_from_address',
                'value' => 'noreply@ckagency.com',
                'type' => 'email',
                'group' => 'email',
            ],
            [
                'key' => 'mail_from_name',
                'value' => 'CK Agency',
                'type' => 'text',
                'group' => 'email',
            ],
            [
                'key' => 'mail_admin_address',
                'value' => 'cynthiankwete@gmail.com',
                'type' => 'email',
                'group' => 'email',
            ],
            [
                'key' => 'mail_notification_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'email',
            ],

            // Configuration Web
            [
                'key' => 'site_url',
                'value' => 'https://ckagency.com',
                'type' => 'url',
                'group' => 'website',
            ],
            [
                'key' => 'site_language',
                'value' => 'fr',
                'type' => 'text',
                'group' => 'website',
            ],
            [
                'key' => 'site_maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'group' => 'website',
            ],
            [
                'key' => 'blog_posts_per_page',
                'value' => '12',
                'type' => 'text',
                'group' => 'website',
            ],
            [
                'key' => 'portfolio_items_per_page',
                'value' => '9',
                'type' => 'text',
                'group' => 'website',
            ],

            // Configuration SEO
            [
                'key' => 'seo_meta_keywords',
                'value' => 'communication, événementiel, agence, Dschang, Cameroun',
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'seo_meta_author',
                'value' => 'CK Agency',
                'type' => 'text',
                'group' => 'seo',
            ],
            [
                'key' => 'google_analytics_id',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
            ],

            // Paramètres Marketing
            [
                'key' => 'newsletter_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'marketing',
            ],
            [
                'key' => 'contact_form_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'marketing',
            ],
            [
                'key' => 'quote_request_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'marketing',
            ],
            [
                'key' => 'comments_enabled',
                'value' => '1',
                'type' => 'boolean',
                'group' => 'marketing',
            ],

            // Pôles de Service
            [
                'key' => 'services_poles',
                'value' => json_encode([
                    [
                        'name' => 'CK EVENT',
                        'subtitle' => 'Excellence Événementielle',
                        'description' => 'Présentation professionnelle de cérémonies, maître de cérémonie, organisation logistique et scénarisation d\'événements prestigieux.',
                        'icon' => 'star',
                        'color' => '#C9A961',
                    ],
                    [
                        'name' => 'CK INFOS+',
                        'subtitle' => 'Presse & Stratégie',
                        'description' => 'Communication globale, gestion des relations médias, production de contenus rédactionnels et conseil en visibilité.',
                        'icon' => 'megaphone',
                        'color' => '#2C3E50',
                    ],
                ]),
                'type' => 'json',
                'group' => 'services',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('✓ Paramètres généraux configurés avec succès');
    }
}
