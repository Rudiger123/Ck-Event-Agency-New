# 🧪 Guide de Test - Système de Notifications

## Test Local (Development)

### 1. Modifier le `MAIL_DRIVER` pour les tests

```env
# .env (Local)
MAIL_MAILER=log
# ou
MAIL_MAILER=array
```

Cela fera que les emails seront loggés au lieu d'être envoyés.

### 2. Test 1: Nouveau Message

```bash
# Lancer la console Tinker
php artisan tinker

# Créer un test message
$message = App\Models\Message::factory()->create([
    'name' => 'Test Client',
    'email' => 'client@test.com',
    'subject' => 'Test Subject',
    'message' => 'Ceci est un message de test pour vérifier le système de notifications.',
]);

# Le MessageObserver devrait automatiquement déclencher l'email
```

**Résultat attendu:**
- ✅ Email créé et loggé en storage/logs/laravel.log
- ✅ Contenu: design noir & or visible
- ✅ Bouton d'action vers Filament: `route('filament.admin.resources.messages.edit', $message)`

### 2. Test 2: Nouvelle Demande de Devis

```bash
php artisan tinker

$quoteRequest = App\Models\QuoteRequest::factory()->create([
    'name' => 'Test Client',
    'email' => 'client@test.com',
    'service_types' => ['Événement', 'Animation'],
    'budget' => '2000€ - 5000€',
    'location' => 'Paris',
]);
```

**Résultat attendu:**
- ✅ Email avec budget visible
- ✅ Services listés
- ✅ Lien vers la resource Filament

### 3. Test 3: Nouveau Commentaire

```bash
php artisan tinker

$comment = App\Models\Comment::factory()->create([
    'name' => 'Lecteur',
    'email' => 'lecteur@test.com',
    'content' => 'Excellent article, très utile!',
    'is_approved' => false,
]);
```

**Résultat attendu:**
- ✅ Email avec statut "En attente"
- ✅ Bouton de modération

## Test Production (Hostinger)

### 1. Configurer MAIL en SMTP

```env
# .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=support@votre-domaine.com
MAIL_PASSWORD=votre-mot-de-passe
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=support@votre-domaine.com
MAIL_FROM_NAME=CK Agency
ADMIN_EMAIL=cynthiankwete@gmail.com
QUEUE_CONNECTION=database
```

### 2. Tester la file d'attente

```bash
# SSH sur Hostinger

# Vérifier les jobs en attente
php artisan queue:failed

# Voir les jobs en queue database
php artisan queue:monitor

# Exécuter un job unique pour tester
php artisan queue:work --once

# Voir les logs
tail -f storage/logs/laravel.log
```

### 3. Démarrer le Queue Worker

```bash
# Sur Hostinger via SSH
cd /home/votre-user/public_html

# Tester le worker
php artisan queue:work --timeout=60 --tries=3

# Ou avec la tâche cron (À ajouter dans cPanel)
* * * * * cd /home/votre-user/public_html && php artisan queue:work --max-jobs=1000 --max-time=3600 >> /dev/null 2>&1
```

### 4. Créer un Test Email

```bash
# Via SSH sur Hostinger
php artisan tinker

# Test 1: Email direct (bypass queue)
Mail::to('cynthiankwete@gmail.com')
    ->send(new App\Mail\NewMessageNotificationMail(
        App\Models\Message::first()
    ));

# Test 2: Email en queue
Mail::to('cynthiankwete@gmail.com')
    ->queue(new App\Mail\NewMessageNotificationMail(
        App\Models\Message::first()
    ));
```

## ✅ Checklist de Tests

- [ ] Email loggé en development correctement
- [ ] Design noir & or visible dans les logs
- [ ] Boutons d'action pointent vers les bonnes URLs
- [ ] SMTP configuré sur Hostinger
- [ ] Queue worker fonctionne
- [ ] Email reçu dans la boîte de Cynthia
- [ ] Email n'a pas d'erreurs SMTP sans crash du site
- [ ] Tous les types de notifications testés (message, devis, commentaire)

## 🔍 Vérification des Logs

```bash
# Voir les logs d'erreur
tail -f storage/logs/laravel.log | grep -i "error\|notification\|mail"

# Voir les logs de queue
tail -f storage/logs/laravel.log | grep -i "queue\|job"

# Voir les erreurs de test
tail -f storage/logs/laravel.log | grep -i "exception"
```

## 🐛 Debug Avancé

### Activer le debug détaillé

```env
# .env
APP_DEBUG=true
LOG_LEVEL=debug
```

### Tester la notificaton manuellement

```php
// routes/web.php (temporaire pour test)
Route::get('/test-notification', function () {
    try {
        $message = App\Models\Message::first();
        Mail::to('cynthia@example.com')
            ->send(new App\Mail\NewMessageNotificationMail($message));
        return "Email enviado!";
    } catch (\Exception $e) {
        return 'Erreur: ' . $e->getMessage();
    }
});
```

Visiter: `http://localhost:8000/test-notification`

---

**Dernière mise à jour:** 20 février 2026
