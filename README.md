# 🌟 CK Event Agency - Premium Communication Platform

[![Laravel 11](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Livewire 3](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Filament PHP](https://img.shields.io/badge/Filament_PHP-3.x-EAB308?style=for-the-badge&logo=filament)](https://filamentphp.com)

**CK Event Agency** est une plateforme web de prestige développée pour l'agence de communication et de presse incarnée par **Cynthia Kenne**. Ce projet allie une architecture technique moderne (TALL Stack) à un design épuré "Noir & Or", reflétant l'excellence et l'élégance de l'événementiel de luxe.

---

## 🚀 Fonctionnalités Clés

### 🌐 Interface Utilisateur (Frontend)
- **Landing Page Narrative :** Présentation immersive de la vision de l'agence, des expertises et des dernières actualités.
- **Média Blog Intelligent :** Système de gestion d'articles avec affichage conditionnel hiérarchisé (Vidéo > Audio > Image).
- **Portfolio Immersif :** Galeries photos haute résolution avec système de Lightbox interactif (Alpine.js).
- **Parcours Gamifié :** Timeline interactive retraçant le parcours professionnel de la fondatrice.
- **Système de Témoignages :** Slider dynamique fluide pour la preuve sociale.
- **Multilingue (V1) :** Architecture prête pour le bilinguisme (Français/Anglais).

### 🛠️ Espace Administration (Back-Office)
- **Dashboard Customisé :** Widgets de statistiques en temps réel, graphiques d'activité et gestion des priorités.
- **Gestionnaire de Devis (CRM) :** Réception des demandes complexes et envoi de propositions commerciales (PDF) directement depuis l'admin.
- **Modération de Contenu :** Gestion complète des commentaires, articles, événements et abonnés newsletter.
- **Réglages Dynamiques :** Contrôle total sur les coordonnées, liens sociaux et SEO sans toucher au code.

---

## 🛠️ Stack Technique

- **Framework :** [Laravel 11](https://laravel.com)
- **Frontend :** [Livewire 3](https://livewire.laravel.com) & [Alpine.js](https://alpinejs.dev)
- **Design :** [Tailwind CSS 4.0](https://tailwindcss.com) (Architecture luxe Noir & Or)
- **Panneau Admin :** [FilamentPHP v3](https://filamentphp.com)
- **Base de données :** MySQL (Production) / SQLite (Local)
- **Gestion Médias :** Spatie MediaLibrary
- **Internationalisation :** Spatie Laravel Translatable

---

## 📦 Installation Locale

1. **Cloner le projet**
   ```bash
   git clone https://github.com/Rudiger123/ck-event-agency.git
   cd ck-event-agency
   Installer les dépendances PHP & JS
```Bash
    composer install
        npm install
    Configuration de l'environnement
```

```Bash
cp .env.example .env
php artisan key:generate
```
Migration et Seed (Données de test)
```Bash
php artisan migrate --seed
```
Lancer les serveurs

```Bash
php artisan serve
npm run dev
```
## 📐 Architecture du Projet
Le projet suit les principes du Clean Code et du Service Pattern :
Models : Utilisation intensive de Traits pour le multilingue et les médias.
Livewire Components : Logique métier isolée pour une réactivité optimale sans rechargement de page.
Filament Resources : Interfaces d'administration hautement personnalisées pour un workflow client simplifié.
## 👤 Crédits & Vision
Inspiration & Fondatrice : Cynthia Kenne
Développement : [Ton Nom ou Pseudo GitHub]
Mission de l'Agence : Valoriser l'information et l'événementiel à travers une communication humaine et prestigieuse.
## ⚖️ Licence
Ce projet est la propriété exclusive de CK Event Agency. Toute reproduction ou utilisation commerciale sans autorisation est interdite.
