# 🔨 Troubleshooting Guide

## 🚨 Common Issues & Solutions

---

## 1. **"Call to undefined function renderSeoHead()"**

### Symptoms
- Error: `Call to undefined function renderSeoHead()`
- Homepage returns 500 error
- Stack trace shows `resources/views/components/layouts/app.blade.php:9`

### Root Causes
- ❌ Composer autoloader not regenerated
- ❌ Helper file not in correct location
- ❌ Laravel cache not cleared

### Solutions

**Step 1**: Verify helper file exists
```bash
ls -la app/Helpers/SeoHelper.php
```

**Step 2**: Regenerate Composer autoloader
```bash
composer dump-autoload
```

**Step 3**: Clear all Laravel caches
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

**Step 4**: Verify helper is loaded
```bash
php -r "require 'vendor/autoload.php'; echo function_exists('renderSeoHead') ? 'OK' : 'FAIL';"
```

**Expected Output:** `OK` ✓

**Step 5**: Test homepage
```bash
curl http://localhost:8000
```

---

## 2. **"No hint path defined for [mail]"**

### Symptoms
- Queue jobs fail silently
- Error in `storage/logs/laravel.log`: `No hint path defined for [mail]`
- Newsletter not sending via queue worker

### Root Causes
- ❌ `config/mail.php` missing markdown section
- ❌ Mail component namespace not registered

### Solutions

**Step 1**: Check config/mail.php
```bash
grep -A3 "markdown" config/mail.php
```

Expected output:
```php
'markdown' => [
    'theme' => 'default',
    'paths' => [resource_path('views/vendor/mail')],
],
```

**Step 2**: If missing, add to config/mail.php:
```php
'markdown' => [
    'theme' => 'default',
    'paths' => [resource_path('views/vendor/mail')],
],
```

**Step 3**: Clear config cache
```bash
php artisan config:clear
php artisan config:cache
```

**Step 4**: Run queue worker to test
```bash
php artisan queue:work --once
```

---

## 3. **"RootTagMissingFromViewException"**

### Symptoms
- Error: `Livewire\Exceptions\RootTagMissingFromViewException`
- Message: "When rendering a Blade view, make sure it contains a root HTML tag"
- Occurs when rendering meta tags

### Root Causes
- ❌ Using `@livewire()` component for meta tags
- ❌ Livewire requires div wrapper, meta tags can't have wrapper

### Solutions

**Step 1**: Replace Livewire component with helper function

**Before (WRONG):**
```blade
@livewire('components.seo-head')
```

**After (CORRECT):**
```blade
{!! renderSeoHead() !!}
```

**Step 2**: Delete unused Livewire component
```bash
rm app/Livewire/Components/SeoHead.php
rm resources/views/livewire/components/seo-head.blade.php
```

**Step 3**: Clear cache and test
```bash
php artisan view:clear
curl http://localhost:8000
```

---

## 4. **Queue Worker Not Processing Emails**

### Symptoms
- Form submitted successfully but no email received
- Jobs table has pending jobs
- Queue worker doesn't seem to be running

### Root Causes
- ❌ Queue worker not started (development)
- ❌ Cron not running (production/Hostinger)
- ❌ SMTP credentials incorrect
- ❌ Jobs stuck in failed state

### Solutions

**Step 1**: Check if jobs are queued
```bash
php artisan tinker
>>> DB::table('jobs')->count()
```

Should return the number of pending jobs.

**Step 2**: Process jobs manually (Development)
```bash
# Process one job
php artisan queue:work --once

# Process continuously (Ctrl+C to stop)
php artisan queue:work
```

**Step 3**: Check failed jobs
```bash
DB::table('failed_jobs')->get()
```

**Step 4**: Verify SMTP credentials in `.env`
```bash
grep -E "MAIL_HOST|MAIL_PORT|MAIL_USERNAME|MAIL_PASSWORD" .env
```

**Step 5**: Test email sending directly
```bash
php artisan tinker
>>> Mail::to('test@example.com')->send(new \App\Mail\TestMail());
```

**Step 6**: For Production (Hostinger) - Verify cron job
```bash
# SSH into Hostinger
ssh user@hostinger

# Check cron logs
cat /tmp/cron.log | tail -20

# Or check Hostinger control panel:
# Cron Jobs section → View Output
```

**Step 7**: Restart queue worker on Hostinger
```bash
# Kill existing processes
killall php

# Or wait for cron to restart automatically
# The cron job has --max-time=3600 so it restarts every hour
```

---

## 5. **Email Templates Not Rendering**

### Symptoms
- Emails blank or have formatting issues
- Error: `View not found` in notifications
- Admin emails empty content

### Root Causes
- ❌ Email template not found
- ❌ Markdown component namespace not working
- ❌ Email content variables not passed

### Solutions

**Step 1**: Verify email template exists
```bash
ls -la resources/views/vendor/mail/html/message.blade.php
```

**Step 2**: Check mail path in config/mail.php
```bash
cat config/mail.php | grep -A5 "markdown"
```

**Step 3**: Publish mail templates (if needed)
```bash
php artisan vendor:publish --tag=laravel-mail
```

**Step 4**: Test email rendering
```bash
php artisan tinker
>>> view('vendor.mail.html.message', [
    'header' => 'Test',
    'salutation' => 'Hello',
    'introLines' => ['Test line 1', 'Test line 2'],
]);
```

---

## 6. **SEO Meta Tags Not Showing on Pages**

### Symptoms
- Page renders but no meta tags in `<head>`
- View source shows no `<title>`, `og:` tags
- Schema JSON-LD not present

### Root Causes
- ❌ SeoService not configured in component
- ❌ Helper function not called
- ❌ SeoService not registered as singleton

### Solutions

**Step 1**: Verify SeoService registered in AppServiceProvider
```bash
grep -A2 "singleton(SeoService" app/Providers/AppServiceProvider.php
```

Should show:
```php
$this->app->singleton(SeoService::class, fn () => new SeoService());
```

**Step 2**: Check ArticleDetail component calls configureSeo()
```bash
grep -A5 "configureSeo" app/Livewire/Blog/ArticleDetail.php
```

Should show call in `mount()` method.

**Step 3**: Verify helper is rendering in layout
```bash
grep "renderSeoHead" resources/views/components/layouts/app.blade.php
```

Should show: `{!! renderSeoHead() !!}`

**Step 4**: Test SEO service directly
```bash
php artisan tinker
>>> app(\App\Services\SeoService::class)->setMeta(['title' => 'Test'])->render();
```

Should output HTML meta tags.

---

## 7. **Images Not Displaying**

### Symptoms
- Broken images in articles/events
- 404 errors for media
- Images work in admin but not frontend

### Root Causes
- ❌ Storage symlink not created
- ❌ Wrong file permissions
- ❌ Media path incorrect

### Solutions

**Step 1**: Create storage symlink
```bash
php artisan storage:link
```

**Step 2**: Verify symlink exists
```bash
ls -la public/storage
```

Should show: `public/storage -> ../storage/app/public`

**Step 3**: Check file permissions
```bash
chmod 755 storage/app/public
chmod 755 storage
```

**Step 4**: Verify media in database
```bash
php artisan tinker
>>> App\Models\Article::first()->media
```

Should show image collection.

---

## 8. **Admin Panel Not Accessible**

### Symptoms
- `/admin` returns 404 or 403 error
- "Not authorized" message
- Filament not loading

### Root Causes
- ❌ Admin user not created
- ❌ Wrong route protection
- ❌ Middleware issue

### Solutions

**Step 1**: Create admin user
```bash
php artisan tinker
>>> App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
]);
```

**Step 2**: Verify route exists
```bash
php artisan route:list | grep admin
```

Should show Filament routes.

**Step 3**: Login at `/admin` with created credentials

---

## 9. **Database Connection Error**

### Symptoms
- "SQLSTATE[HY000]: General error" when accessing database
- "Connection refused" or "No such file"
- Queries failing randomly

### Root Causes
- ❌ `.env` DATABASE_URL incorrect
- ❌ Database server not running (production)
- ❌ SQLite file deleted

### Solutions

**Step 1**: Check `.env` database configuration
```bash
grep -E "DB_|DATABASE" .env
```

**Step 2**: For SQLite (development)
```bash
# Create or restore database
cp ck_event_agency.sqlite.backup ck_event_agency.sqlite

# Run migrations
php artisan migrate
```

**Step 3**: For MySQL (production)
```bash
# Test connection
mysql -h <host> -u <user> -p -e "SELECT 1;"

# Check config/database.php has correct settings
```

---

## 10. **Composer Install Errors**

### Symptoms
- `composer install` fails with errors
- "Package not found" or "conflict"
- Disk space issues

### Root Causes
- ❌ Incompatible PHP version
- ❌ Package conflicts
- ❌ Out of disk space

### Solutions

**Step 1**: Check PHP version
```bash
php -v
```

Should be PHP 8.2+

**Step 2**: Verify composer.json requirements
```bash
grep '"php"' composer.json
```

**Step 3**: Update composer
```bash
composer self-update
composer update
```

**Step 4**: Check disk space
```bash
df -h
```

---

## 🔍 Debugging Commands

### View Latest Error
```bash
tail -50 storage/logs/laravel.log
```

### Watch Log in Real-time
```bash
tail -f storage/logs/laravel.log
```

### Database Queries
```bash
php artisan tinker
>>> DB::listen(fn($query) => dump($query->sql, $query->bindings));
>>> App\Models\Article::first();
```

### Check Service Status
```bash
php artisan optimize
php artisan config:show
php artisan about
```

### Test Email Configuration
```bash
php artisan tinker
>>> config('mail')
```

### List All Routes
```bash
php artisan route:list
```

### Check Registered Services
```bash
php artisan tinker
>>> app()->getLoadedProviders()
```

---

## 📞 Support Workflow

### When Something Breaks

1. **Check the logs first**
   ```bash
   tail -50 storage/logs/laravel.log
   ```

2. **Clear caches**
   ```bash
   php artisan cache:clear
   php artisan view:clear
   php artisan config:clear
   ```

3. **Regenerate autoloader**
   ```bash
   composer dump-autoload
   ```

4. **Test with Tinker**
   ```bash
   php artisan tinker
   ```

5. **Check .env file**
   ```bash
   cat .env | grep -E "APP_|DB_|MAIL_"
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Still broken?**
   - Review this guide for similar issues
   - Check DEPLOYMENT_CHECKLIST.md
   - Check SYSTEM_OVERVIEW.md for architecture

---

**Last Updated:** 21 février 2026  
**Version:** 1.0  
**Status:** ✅ Production-Ready
