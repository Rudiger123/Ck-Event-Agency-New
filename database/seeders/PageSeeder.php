<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'key' => 'about',
                'title' => 'Cynthia Kenne : Une vocation au service de l’impact',
                'content' => "Animée depuis le bas âge par la prise de parole en public et l’animation d’évènements, la communication s’est très tôt imposée à moi comme une vocation. Le micro, la scène et l’interaction avec le public ont toujours été mes espaces naturels d’expression, d’engagement et d’épanouissement personnel.

Mon parcours n’a rien de linéaire ; il est le fruit d’une curiosité insatiable et d’une passion dévorante pour l’humain. De la rigueur de l'écriture journalistique à l'adrénaline de la présentation scénique, j'ai toujours cherché le ton juste, celui qui résonne et qui fédère.

UN PARCOURS ACADÉMIQUE D'EXCELLENCE
Après l’obtention du Baccalauréat au Lycée Bilingue de Dschang, je me suis orientée vers des études trilingues en allemand, fortement inspirée par la rigueur intellectuelle de mon père, professeur à l’Université de Dschang. Ce choix a renforcé mon intérêt pour les métiers de la transmission. J'ai ensuite rejoint la filière Sciences de l’Information et de la Communication (SIC) où j'ai consacré mon parcours en 2024 par l'obtention d'un Master II avec une mention Très Bien (17/20).

L'EXPÉRIENCE DU TERRAIN : DE LA RADIO À LA RÉDACTION EN CHEF
Désireuse de joindre la théorie à la pratique, j'ai fait mes preuves à la radio Nkwalah 100.0 FM à Dschang. Grâce à mon sérieux et mon sens de l'initiative, j'y ai évolué de stagiaire à journaliste, pour finir Rédactrice en Chef pendant plus d'un an. Cette fonction stratégique m'a permis d'assurer la coordination éditoriale et l'encadrement d'équipe au plus haut niveau.

AUJOURD'HUI : CK AGENCY
Aujourd'hui, je mets cette double expertise académique et professionnelle au service de vos projets à travers CK Agency, structurée autour de deux pôles : CK EVENT pour l'excellence événementielle et CK INFOS+ pour la valorisation de l'information.

Professionnalisme, rigueur, créativité et sens de l’écoute constituent les piliers de mon engagement. Peu importe le projet : ayez confiance. La communication, lorsqu’elle est bien pensée et bien portée, devient un puissant levier d’impact.",
            ],
            [
                'key' => 'services',
                'title' => 'Nos Expertises : Communication & Knowledge',
                'content' => "CK Agency se positionne au carrefour de l'information et de l'événementiel. Notre approche globale nous permet de garantir une cohérence parfaite entre votre image de marque et vos moments forts.

PÔLE CK EVENT (ÉVÉNEMENTIEL PRESTIGIEUX)
- Présentation professionnelle de cérémonies (Mariages, Galas, Soirées VIP).
- Maître de cérémonie (MC) pour événements institutionnels et corporatifs.
- Organisation et coordination logistique d'activités événementielles.
- Scénarisation d'événements et gestion du protocole.

PÔLE CK INFOS+ (PRESSE & STRATÉGIE)
- Coordination de projets de communication globale.
- Communication de presse et gestion des relations médias.
- Production de contenus rédactionnels, audios et vidéos de haute qualité.
- Conseil en visibilité et valorisation stratégique de l'information.

POURQUOI CHOISIR CK AGENCY ?
Notre force réside dans une expertise certifiée (Master II SIC) couplée à une expérience réelle de rédaction en chef. Nous ne nous contentons pas de diffuser, nous donnons du sens à votre communication.",
            ],
            [
                'key' => 'mentions-legales',
                'title' => 'Mentions Légales',
                'content' => "ÉDITEUR DU SITE
Le site ckagency.hradschang.org est édité par CK Agency.
Directrice de la publication : Cynthia Kenne.
Siège social : Dschang, Cameroun.
Contact : cynthiankwete@gmail.com | Tél : +237 654 81 12 69.

HÉBERGEMENT
Le site est hébergé par Hostinger International Ltd.
61 Lordou Vironos Street, 6023 Larnaca, Chypre.

PROPRIÉTÉ INTELECTUELLE
L'ensemble des contenus (textes, images, logos) est la propriété exclusive de CK Agency. Toute reproduction sans accord préalable est interdite.",
            ],
            [
                'key' => 'politique-confidentialite',
                'title' => 'Politique de Confidentialité',
                'content' => "CK Agency accorde une importance capitale à la protection de vos données.

COLLECTE DES DONNÉES
Nous collectons vos données (nom, email, téléphone) uniquement via les formulaires de contact, de devis et d'inscription à la newsletter pour répondre à vos besoins.

UTILISATION ET SÉCURITÉ
Vos données ne sont jamais vendues à des tiers. Elles sont utilisées exclusivement pour le traitement de vos demandes professionnelles.

VOS DROITS
Vous disposez d'un droit d'accès, de modification et de suppression de vos données personnelles sur simple demande à cynthiankwete@gmail.com.",
            ],
        ];
        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['key' => $pageData['key']],
                [
                    'slug' => Str::slug($pageData['title']),
                    'is_active' => true,
                    // On passe les traductions directement ici en format tableau
                    'title' => ['fr' => $pageData['title']],
                    'content' => ['fr' => $pageData['content']],
                ]
            );
        }
    }
}
