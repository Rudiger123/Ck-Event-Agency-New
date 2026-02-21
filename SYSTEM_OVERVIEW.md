# 🏗️ CK Event Agency - System Architecture Overview

## 📊 Project Structure

```
ck-event-agency/
├── app/
│   ├── Filament/              # Admin panel resources & pages
│   ├── Http/                  # Controllers & middleware
│   ├── Livewire/              # Page components (ArticleDetail, EventDetail, HomePage)
│   ├── Mail/                  # Email templates (notifications)
│   ├── Models/                # Eloquent models (Article, Event, Message, etc.)
│   ├── Observers/             # Event observers (auto-trigger emails)
│   ├── Providers/             # Service providers (AppServiceProvider, etc.)
│   ├── Services/              # Business logic (SeoService, SchemaGenerator)
│   └── Helpers/               # Global helper functions (SeoHelper)
├── config/                    # Configuration files (app.php, mail.php, queue.php)
├── database/                  # Migrations, factories, seeders
├── resources/
│   ├── views/                 # Blade templates
│   ├── js/                    # Alpine.js, JavaScript
│   └── css/                   # Tailwind CSS
├── routes/                    # Route definitions (web.php)
├── storage/                   # Logs, cache, uploads
├── vendor/                    # Composer dependencies
└── tests/                     # Unit & feature tests
```

## 🔄 Request Flow Architecture

### 1. **User Request → Router**
```
GET /blog/article-slug
     ↓
routes/web.php (Livewire route)
     ↓
ArticleDetail.php (Livewire component)
```

### 2. **Component Lifecycle**
```
mount()
  ├─ Load article from database
  ├─ Call configureSeo()
  │   ├─ seo()->setMeta(...)
  │   ├─ seo()->setOpenGraph(...)
  │   └─ seo()->setSchema(...)
  └─ Return $this
     ↓
render()
  └─ Return view with article data
```

### 3. **View Rendering**
```
resources/views/components/layouts/app.blade.php
  ├─ {!! renderSeoHead() !!}  (helper function)
  │   └─ SeoService::render()  (get meta tags & schemas)
  │
  ├─ @livewire('page-component')
  │   └─ ArticleDetail component
  │
  └─ HTML content
```

### 4. **Browser Receives**
```html
<!DOCTYPE html>
<html>
<head>
    <title>Article Title</title>
    <meta name="description" content="...">
    <meta property="og:title" content="...">
    <meta property="og:image" content="...">
    <script type="application/ld+json">...</script>
</head>
<body>
    <article>...</article>
</body>
</html>
```

## 💾 Service Architecture

### **SeoService** (`app/Services/SeoService.php`)
```php
class SeoService
{
    private $meta = [];
    private $openGraph = [];
    private $schema = null;

    public function setMeta(array $data): self
    public function setOpenGraph(array $data): self  
    public function setSchema($schema): self
    public function render(): string  // HTML output
}
```

**Singleton Registration** (AppServiceProvider.php):
```php
$this->app->singleton(SeoService::class, fn () => new SeoService());
```

**Usage in ArticleDetail**:
```php
public function mount($slug)
{
    $this->article = Article::where('slug', $slug)->firstOrFail();
    $this->configureSeo();  // ← Configures singleton instance
}

private function configureSeo()
{
    seo()
        ->setMeta(['title' => $this->article->title])
        ->setOpenGraph([
            'title' => $this->article->title,
            'description' => $this->article->excerpt,
            'image' => $this->article->featured_image,
        ])
        ->setSchema(
            SchemaGenerator::newsArticle($this->article)
        );
}
```

### **SchemaGenerator** (`app/Services/Schemas/SchemaGenerator.php`)
```php
class SchemaGenerator
{
    public static function organization(): array
    public static function newsArticle(Article $article): array
    public static function event(Event $event): array
    public static function breadcrumb(array $items): array
}
```

**Output**: JSON-LD structured data for search engines
```json
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "Article Title",
  "description": "...",
  "image": "...",
  "datePublished": "2026-02-21",
  "author": {
    "@type": "Person",
    "name": "Author Name"
  }
}
```

## 📧 Email & Notification System

### **Observer Pattern**
```
User Action
  ├─ Message submitted → MessageObserver::created()
  │     └─ Mail::to(admin_email)->queue(NewMessageNotificationMail)
  │
  ├─ Quote request submitted → QuoteRequestObserver::created()
  │     └─ Mail::to(admin_email)->queue(NewQuoteRequestNotificationMail)
  │
  └─ Comment posted → CommentObserver::created()
        └─ Mail::to(admin_email)->queue(NewCommentNotificationMail)
```

### **Observers Location**
- `app/Observers/MessageObserver.php`
- `app/Observers/QuoteRequestObserver.php`
- `app/Observers/CommentObserver.php`

**Auto-registered** in `AppServiceProvider.boot()`:
```php
Message::observe(MessageObserver::class);
QuoteRequest::observe(QuoteRequestObserver::class);
Comment::observe(CommentObserver::class);
```

### **Error Resilience**
```php
try {
    Mail::to(config('app.admin_email'))
        ->queue(new NewMessageNotificationMail($message));
} catch (Exception $e) {
    logger()->error('Failed to queue message notification: ' . $e->getMessage());
}
```

## 🔐 Configuration Management

### **`config/app.php`** (SEO Data)
```php
'admin_email' => env('ADMIN_EMAIL', 'admin@example.com'),
'phone' => env('APP_PHONE', '+33...'),
'email' => env('APP_EMAIL', 'contact@example.com'),
'founding_date' => env('APP_FOUNDING_DATE', 2020),
'address' => [
    'street' => env('APP_ADDRESS_STREET', ''),
    'city' => env('APP_ADDRESS_CITY', ''),
    'postal_code' => env('APP_ADDRESS_POSTAL_CODE', ''),
    'country' => env('APP_ADDRESS_COUNTRY', 'France'),
],
'social' => [
    'facebook' => env('APP_SOCIAL_FACEBOOK', ''),
    'instagram' => env('APP_SOCIAL_INSTAGRAM', ''),
    'linkedin' => env('APP_SOCIAL_LINKEDIN', ''),
    'twitter' => env('APP_SOCIAL_TWITTER', ''),
],
```

### **`config/mail.php`** (Email Configuration)
```php
'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
    'name' => env('MAIL_FROM_NAME', 'Laravel'),
],
'markdown' => [
    'theme' => 'default',
    'paths' => [resource_path('views/vendor/mail')],
],
```

### **`config/queue.php`** (Job Processing)
```php
'default' => env('QUEUE_CONNECTION', 'sync'),  // 'database' for Hostinger
'connections' => [
    'database' => [
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
    ],
],
```

## 🚀 Queue System (Email Sending)

### **Development** (SQLite)
```
Form Submission
  ↓
Observer created event
  ↓
Mail::queue() adds to jobs table
  ↓
Manual: php artisan queue:work
  ↓
Email sent via SMTP
```

### **Production** (Hostinger - Cron-based)
```
Form Submission
  ↓
Observer created event
  ↓
Mail::queue() adds to jobs table
  ↓
Cron runs every minute:
  * * * * * php artisan queue:work --max-jobs=1000 --max-time=3600
  ↓
Email sent via SMTP
```

### **Cron Configuration** (Hostinger)
```bash
# Add to crontab via Hostinger control panel:
* * * * * cd /home/username/public_html && php artisan queue:work --max-jobs=1000 --max-time=3600
```

## 🎨 Helper Functions

### **`app/Helpers/SeoHelper.php`**
Auto-loaded via `composer.json`:
```php
// Get SeoService singleton
seo()
  
// Render SEO head tags & schemas
{!! renderSeoHead() !!}  // Used in app.blade.php

// Quick helper to set meta
setSeoMeta(['title' => '...', 'description' => '...'])
```

## 🧪 Testing & Verification

### **Test Homepage**
```bash
curl http://localhost:8000 | grep -i '<title>\|og:title'
```

### **Test Article Page**
```bash
curl http://localhost:8000/blog/article-slug | grep -i 'ld+json'
```

### **Verify Helper Loading**
```bash
php -r "require 'vendor/autoload.php'; echo function_exists('renderSeoHead') ? 'OK' : 'FAIL';"
```

### **Check Queue Jobs**
```bash
sqlite3 ck_event_agency.sqlite "SELECT * FROM jobs;"
```

### **Process Queue Manually**
```bash
php artisan queue:work --once  # Process one job
php artisan queue:work         # Process continuously
```

## 📈 Performance Optimization

### **Caching**
```bash
php artisan config:cache    # Cache config values
php artisan route:cache     # Cache routes
php artisan view:cache      # Cache compiled views
```

### **Query Optimization**
- ✓ Article/Event queries use `->with('media')` for eager loading
- ✓ Comments filtered with `->where('is_approved', true)`
- ✓ Pagination limits queries

### **Frontend Optimization**
- ✓ CSS/JS minified via build tools
- ✓ Images served from Spatie MediaLibrary
- ✓ Fonts from Google CDN (cached)

## 🔍 Search Engine Optimization (SEO)

### **Meta Tags**
- Dynamic title & description per page
- Open Graph for social media sharing
- Twitter Cards for Twitter

### **Structured Data** (JSON-LD)
- Organization schema (homepage)
- NewsArticle schema (blog articles)
- Event schema (portfolio events)
- BreadcrumbList for navigation

### **Sitemap & Robots**
- `public/robots.txt` for crawler instructions
- Sitemap auto-generated by framework or manual

### **Google Search Console**
- Track indexing status
- Monitor search performance
- Fix crawl errors

## 📋 Key Dependencies

```json
{
  "laravel/framework": "^12.0",
  "filament/filament": "^3.2",
  "livewire/livewire": "^3.0",
  "spatie/laravel-medialibrary": "^11.17",
  "spatie/laravel-translatable": "^6.12"
}
```

## 🎯 Feature Checklist

### ✅ Implemented Features
- [x] Multi-language support (Spatie Translatable)
- [x] Media management (Spatie MediaLibrary)
- [x] Admin panel (Filament)
- [x] SEO system (native, no external package)
- [x] Email notifications (observer pattern)
- [x] Queue system for emails
- [x] Article management
- [x] Event management
- [x] Newsletter subscription
- [x] Contact form with validation
- [x] Quote request form

### ⏳ Future Enhancements
- [ ] Email templates with custom branding
- [ ] Advanced analytics dashboard
- [ ] API for mobile app
- [ ] Scheduled newsletter campaigns
- [ ] Customer feedback system
- [ ] Advanced reporting

## 🔱 Architecture Principles

1. **Separation of Concerns**: Services handle business logic, Controllers/Livewire handle requests
2. **DRY (Don't Repeat Yourself)**: Helpers & services centralize common logic
3. **Resilience**: Try/catch blocks prevent mail crashes
4. **Performance**: Lazy loading, caching, query optimization
5. **Scalability**: Queue system handles high email volume
6. **SEO-First**: All pages have proper meta tags & structured data

---

**This architecture is production-ready and optimized for CK Event Agency's needs.**  
**Status:** ✅ Ready for Deployment

**Last Updated:** 21 février 2026
