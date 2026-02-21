# 🚀 Guide SEO Complet - CK Agency

## Vue d'ensemble

CK Agency dispose maintenant d'un système SEO natif, léger et performant basé sur:
- **SeoService**: Gestion centralisée des meta tags et schemas
- **SchemaGenerator**: Création de schémas JSON-LD structurés
- **Composants Livewire**: Injection dynamique des métadonnées

## 🎯 Architecture

### 1. **SeoService** (`app/Services/SeoService.php`)

Service principal pour gérer tous les meta tags et schemas JSON-LD.

```php
// Utilisation basique
SeoService::for()
    ->setMeta([
        'title' => 'Mon Article',
        'description' => 'Description courte',
        'keywords' => 'seo, article, luxe',
        'canonical' => 'https://monsite.com/article',
    ])
    ->setOpenGraph([
        'title' => 'Mon Article',
        'description' => 'Pour Facebook',
        'type' => 'article',
        'url' => 'https://monsite.com/article',
        'image' => 'https://image.jpg',
    ])
    ->setSchema(json_encode([...]))  // JSON-LD Schema
    ->render();  // Rendre le HTML
```

**Fonctionnalités:**
- ✅ Meta tags standard (title, description, keywords)
- ✅ Open Graph tags (Facebook, LinkedIn, WhatsApp)
- ✅ Twitter Card tags
- ✅ Canonical URL
- ✅ JSON-LD Schema injection

### 2. **SchemaGenerator** (`app/Services/Schemas/SchemaGenerator.php`)

Génère les structures de données schema.org au format JSON-LD.

**Schémas disponibles:**

#### Organization (Homepage)
```php
SchemaGenerator::organization()
// Génère un schema Organization avec:
// - Nom, description, logo
// - Contact, adresse, téléphone
// - Réseaux sociaux
// - Zone de service
```

#### NewsArticle (Articles)
```php
SchemaGenerator::newsArticle($article)
// Génère un schema NewsArticle avec:
// - Titre, description, image
// - Date publication/modification
// - Auteur (Cynthia Kenne)
// - Publisher (Organisation)
// - Keywords
```

#### Event (Événements)
```php
SchemaGenerator::event($event)
// Génère un schema Event avec:
// - Nom, description, image
// - Date et lieu
// - Organisateur
// - URL et type d'événement
```

#### BreadcrumbList (Navigation)
```php
SchemaGenerator::breadcrumb([
    ['name' => 'Home', 'url' => '/'],
    ['name' => 'Blog', 'url' => '/blog'],
    ['name' => 'Article', 'url' => '/blog/article'],
])
```

### 3. **Helper Blade Global**

#### renderSeoHead()
Affiche les meta tags et schemas directement dans le `<head>` (sans wrapper Livewire).

```blade
<!-- Dans resources/views/components/layouts/app.blade.php -->
{!! renderSeoHead() !!}
```

### 4. **Composants Livewire**

#### ArticleDetail
Configure automatiquement le SEO lors de la lecture d'un article.

```php
public function mount($slug)
{
    $this->article = Article::where('slug', $slug)->firstOrFail();
    $this->configureSeo();  // Configure les meta tags
}
```

#### EventDetail
Configure automatiquement le SEO lors de la lecture d'un événement.

## 📋 Configuration

### Variables d'Environnement

Ajouter à `.env`:

```env
# Informations Organisation
APP_PHONE=+33 1 23 45 67 89
APP_EMAIL=contact@ck-agency.com
APP_FOUNDING_DATE=2020

# Adresse
APP_ADDRESS_STREET="123 Rue de la Paix"
APP_ADDRESS_CITY="Paris"
APP_ADDRESS_POSTAL_CODE="75001"
APP_ADDRESS_COUNTRY="FR"

# Réseaux Sociaux
APP_SOCIAL_FACEBOOK=https://facebook.com/ckagency
APP_SOCIAL_INSTAGRAM=https://instagram.com/ckagency
APP_SOCIAL_LINKEDIN=https://linkedin.com/company/ckagency
APP_SOCIAL_TWITTER=https://twitter.com/ckagency
```

### Configuration App (`config/app.php`)

```php
'phone' => env('APP_PHONE', ''),
'email' => env('APP_EMAIL', ''),
'founding_date' => env('APP_FOUNDING_DATE', '2020'),

'address' => [
    'street' => env('APP_ADDRESS_STREET', ''),
    'city' => env('APP_ADDRESS_CITY', ''),
    'postal_code' => env('APP_ADDRESS_POSTAL_CODE', ''),
    'country' => env('APP_ADDRESS_COUNTRY', 'FR'),
],

'social' => [
    'facebook' => env('APP_SOCIAL_FACEBOOK', ''),
    'instagram' => env('APP_SOCIAL_INSTAGRAM', ''),
    'linkedin' => env('APP_SOCIAL_LINKEDIN', ''),
    'twitter' => env('APP_SOCIAL_TWITTER', ''),
],
```

## 🎨 Meta Tags Requises

### Dans Filament (Lors de création d'article/événement)

Remplir les champs:
- `meta_title`: **Titre SEO** (50-60 caractères)
- `meta_description`: **Description** (150-160 caractères)
- `meta_keywords` (Articles seulement): **Mots-clés** (5-7 mots)

**Exemple:**
```
Titre: Notre événement de prestige - CK Agency
Description: Découvrez comment CK Agency a orchestré ce gala de luxe avec élégance et professionnalisme.
Keywords: événement luxe, gala, communication événementielle
```

## 🔍 Vérification SEO

### 1. Checker les Meta Tags

```bash
# Via curl
curl -s https://votre-site.com/blog/mon-article | grep -E '<title|og:|description'

# Via le navigateur
# F12 → Elements → <head> → chercher <meta>, <title>, <script type="application/ld+json">
```

### 2. Valider les Schemas JSON-LD

- Google: https://search.google.com/structured-data/testing-tool
- Schema.org: https://validator.schema.org

### 3. Tester les Open Graph

- Facebook: https://developers.facebook.com/tools/debug/og/object
- LinkedIn: https://www.linkedin.com/post-inspector

## 📊 Impact SEO

### Ce que Google voit maintenant:

✅ **Organization Schema** → Google reconnaît CK Agency comme une agence officielle
✅ **NewsArticle Schema** → Les articles sont mieux indexés
✅ **Event Schema** → Les événements apparaissent dans Google Events
✅ **Canonical URLs** → Évite le contenu dupliqué
✅ **Open Graph** → Mieux visible sur réseaux sociaux
✅ **Keywords & Descriptions** → Meilleur taux de clics dans SERPs

### Résultats attendus:

- 📈 Meilleur classement pour "agence événementiel luxe France"
- 📈 Meilleur CTR dans les résultats Google
- 📈 Meilleure visibilité sur réseaux sociaux
- 📈 Plus de trafic organique

## 🚀 Utilisation Avancée

### Ajouter SEO à une nouvelle page

```php
// Dans votre Livewire component
use App\Services\SeoService;
use App\Services\Schemas\SchemaGenerator;

public function mount()
{
    SeoService::for()
        ->setMeta([
            'title' => 'Ma Page',
            'description' => 'Description',
            'canonical' => route('ma-page'),
        ])
        ->setOpenGraph([
            'title' => 'Ma Page',
            'url' => route('ma-page'),
            'image' => asset('image.jpg'),
        ])
        ->setSchema(SchemaGenerator::breadcrumb([
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Ma Page', 'url' => route('ma-page')],
        ]));
}
```

### Utiliser les helpers

```php
// Dans un controller ou livewire
setSeoMeta([
    'title' => 'Mon Titre',
    'description' => 'Ma description',
])->setOpenGraph([
    'title' => 'Pour Facebook',
]);

// Rendre les tags
echo renderSeoHead();
```

## ⚡ Performance

### Taille des Schemas

- **Organization**: ~2KB (chargé une fois par session)
- **NewsArticle**: ~1.5KB (par article)
- **Event**: ~1.5KB (par événement)

**Impact:** Négligeable sur le temps de chargement

### Caching Recommandé

```php
// Dans config/app.php
'seo' => [
    'cache' => true,  // Cacher les schemas
    'cache_duration' => 3600,  // 1 heure
],
```

## 🔗 Ressources

- [Google Search Console](https://search.google.com/search-console)
- [Google Mobile-Friendly](https://search.google.com/test/mobile-friendly)
- [Schema.org Documentation](https://schema.org)
- [Open Graph](https://ogp.me/)

---

**Système SEO:** ✅ Prêt pour production  
**Performance:** ✅ Optimisé  
**Indexabilité:** ✅ Google-friendly
