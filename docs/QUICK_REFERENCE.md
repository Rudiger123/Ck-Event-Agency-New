# ⚡ Quick Reference Guide

## 🚀 Most Common Commands

### Development Start
```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed

# Build assets
npm run dev

# Start server
php artisan serve
```

### Production Deployment
```bash
# On Hostinger via SSH
composer install --no-dev --optimize-autoloader
php artisan config:clear && php artisan cache:clear
php artisan migrate --force
php artisan config:cache && php artisan view:cache
php artisan storage:link
npm run build
```

### Cache Management
```bash
# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear

# Regenerate caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Reset everything
php artisan optimize:clear
```

### Queue Management
```bash
# Process all jobs
php artisan queue:work

# Process one job
php artisan queue:work --once

# List failed jobs
php artisan queue:failed

# Retry failed job
php artisan queue:retry 1

# Clear all failed jobs
php artisan queue:flush
```

### Database
```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh database (! WARNING: deletes all data)
php artisan migrate:fresh

# Seed database
php artisan db:seed

# Tinker (REPL)
php artisan tinker
```

### Composer
```bash
# Update dependencies
composer update

# Regenerate autoloader
composer dump-autoload

# Optimize autoloader
composer dump-autoload -o

# Check for security vulnerabilities
composer audit
```

### Admin Panel
```bash
# Publish Filament assets
php artisan filament:install

# Create admin user (in tinker)
php artisan tinker
# User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')])
```

---

## 🔧 troubleshooting Quick Fixes

| Problem | Solution |
|---------|----------|
| **"Call to undefined function renderSeoHead()"** | `composer dump-autoload` then `php artisan cache:clear` |
| **"No hint path defined for [mail]"** | Check `config/mail.php` has markdown section |
| **"RootTagMissingFromViewException"** | Replace `@livewire()` with `{!! renderSeoHead() !!}` in layout |
| **Emails not sending** | Run `php artisan queue:work` and check `.env` SMTP settings |
| **Images not showing** | Run `php artisan storage:link` |
| **Admin panel 404** | Create user in Tinker: `User::create([...])` |
| **Database errors** | Check `.env` DB credentials, run `php artisan migrate` |
| **CSS/JS not loading** | Run `npm run build` and `php artisan vendor:publish` |

---

## 📝 Configuration Files

### Critical Settings in `.env`
```bash
APP_ENV=production          # Set to 'production' on live
APP_DEBUG=false             # NEVER true in production
APP_KEY=                    # Run: php artisan key:generate

ADMIN_EMAIL=                # Email for notifications
QUEUE_CONNECTION=database   # For email queue

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=ck_agency
DB_USERNAME=root
DB_PASSWORD=

# Mail (SMTP)
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
```

### Key Config Files
- `config/app.php` - SEO data (admin_email, phone, address, social)
- `config/mail.php` - Email configuration (markdown section!)
- `config/queue.php` - Queue driver settings
- `config/database.php` - Database connection

---

## 🗂️ File Structure Overview

```
app/
  ├── Services/
  │   ├── SeoService.php          # SEO meta tags & schemas
  │   └── Schemas/SchemaGenerator.php
  ├── Livewire/
  │   ├── Blog/ArticleDetail.php  # Sets SEO per article
  │   ├── Portfolio/EventDetail.php
  │   └── HomePage.php
  ├── Observers/
  │   ├── MessageObserver.php     # Triggers email notifications
  │   ├── CommentObserver.php
  │   └── QuoteRequestObserver.php
  ├── Helpers/
  │   └── SeoHelper.php           # Global helper functions
  └── Providers/
      └── AppServiceProvider.php  # Registers singletons

resources/views/
  └── components/layouts/
      └── app.blade.php           # Uses {!! renderSeoHead() !!}

config/
  ├── app.php                     # SEO data
  ├── mail.php                    # SMTP + markdown
  └── queue.php                   # Job processing
```

---

## 🎯 Key Concepts

### **Singleton Pattern**
One instance per request lifecycle:
```php
// Registered in AppServiceProvider
$this->app->singleton(SeoService::class, fn () => new SeoService());

// Used throughout the request
seo()->setMeta(...)->setOpenGraph(...)  // Modifies same instance
```

### **Observer Pattern**
Auto-triggered database events:
```php
// In AppServiceProvider.boot()
Message::observe(MessageObserver::class);

// In MessageObserver.php
public function created(Message $message) {
    Mail::queue(new NewMessageNotificationMail($message));
}
```

### **Queue System**
Asynchronous job processing:
```php
// In observer or controller
Mail::to('admin@example.com')->queue(new EmailClass());

// Job stored in database table 'jobs'
// Executed by: php artisan queue:work
// Or on Hostinger via cron every minute
```

### **Livewire Lifecycle**
Component hooks:
```php
public function mount()      // Called when component created
public function updating()   // Before property updates
public function updated()    // After property updates
public function render()     // Return view
```

---

## 📊 Database Tables

### Key Tables
| Table | Purpose |
|-------|---------|
| `articles` | Blog posts |
| `events` | Portfolio events |
| `comments` | Blog article comments |
| `messages` | Contact form submissions |
| `quote_requests` | Quote request forms |
| `newsletter_subscribers` | Email list |
| `jobs` | Queued emails |
| `failed_jobs` | Failed email attempts |
| `media` | Spatie: Images & files |

### Key Relationships
```
Article ← has many → Comments
Article ← has many → Media (images)
Event ← has many → Media (images)
Message → triggers → NewMessageNotificationMail
QuoteRequest → triggers → NewQuoteRequestNotificationMail
Comment → triggers → NewCommentNotificationMail
```

---

## 🔐 Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_KEY` generated: `php artisan key:generate`
- [ ] `.env` file not accessible from web
- [ ] HTTPS enabled on Hostinger
- [ ] Session cookies secure
- [ ] CSRF protection enabled
- [ ] SQL injection prevented (use Eloquent)
- [ ] Admin paths protected
- [ ] Database credentials strong
- [ ] Logs don't expose sensitive data

---

## 📈 Monitoring & Logging

### Check Logs
```bash
# Last 50 lines
tail -50 storage/logs/laravel.log

# Live tail
tail -f storage/logs/laravel.log

# Search for errors
grep -i "error\|exception" storage/logs/laravel.log
```

### Monitor Queue
```bash
# Check pending jobs
php artisan tinker
>>> DB::table('jobs')->count()

# Check failed jobs
>>> DB::table('failed_jobs')->get()

# Process manually
php artisan queue:work --once
```

### Debug Database
```php
DB::listen(fn($query) => dump($query->sql, $query->bindings));
```

---

## 🌐 SEO Checklist

- [ ] Title tags set correctly
- [ ] Meta descriptions present
- [ ] Open Graph tags for sharing
- [ ] JSON-LD schemas for search engines
- [ ] Images have alt text
- [ ] URLs are SEO-friendly (slugs)
- [ ] Sitemap submitted to Google
- [ ] Robots.txt configured
- [ ] Google Search Console setup
- [ ] Mobile-friendly design

---

## 💡 Performance Tips

1. **Use Caching**
   ```php
   Cache::remember('key', 3600, fn() => expensive_operation());
   ```

2. **Eager Load Relations**
   ```php
   Article::with('comments', 'media')->get();
   ```

3. **Paginate Large Datasets**
   ```php
   Article::paginate(15);
   ```

4. **Minimize Database Queries**
   - Use select('column') to get specific columns
   - Avoid N+1 queries (use with())

5. **Queue Heavy Operations**
   ```php
   Mail::queue(...);  // Don't process inline
   ```

---

## 🚨 Emergency Commands

If something is completely broken:

```bash
# Full reset (⚠️ WARNING: DELETES DATA)
php artisan migrate:fresh --seed

# Clear everything and rebuild
php artisan optimize:clear
composer dump-autoload -o
npm run build

# Restore from backup
mysql database_name < backup.sql
```

---

## 📚 Resources & Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Livewire Documentation](https://livewire.laravel.com/docs)
- [Spatie Packages](https://spatie.be/open-source)
- [SEO Best Practices](https://developers.google.com/search)

---

**Last Updated:** 21 février 2026  
**Quick Reference Version:** 1.0
