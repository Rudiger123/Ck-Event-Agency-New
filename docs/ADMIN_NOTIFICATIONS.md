# 🔔 Système de Notifications Admin (Noir & Or)

## Vue d'ensemble

Un système automatisé et élégant pour alerter Cynthia instantanément de chaque nouvelle opportunité d'affaires via email avec design premium (Noir & Or).

## Architecture

### 1. **Observers Laravel**
Les observers écoutent les changements de modèle et declenchent automatiquement les notifications.

**Fichiers concernés:**
- `app/Observers/MessageObserver.php` - Notifications pour nouveaux messages
- `app/Observers/QuoteRequestObserver.php` - Notifications pour demandes de devis
- `app/Observers/CommentObserver.php` - Notifications pour nouveaux commentaires

**Enregistrement:**
```php
// app/Providers/AppServiceProvider.php
Message::observe(MessageObserver::class);
QuoteRequest::observe(QuoteRequestObserver::class);
Comment::observe(CommentObserver::class);
```

### 2. **Mailable Classes**
Les mailable gèrent le contenu et l'envoi des emails.

**Fichiers:**
- `app/Mail/NewMessageNotificationMail.php`
- `app/Mail/NewQuoteRequestNotificationMail.php`
- `app/Mail/NewCommentNotificationMail.php`
- `app/Mail/AdminNotificationMail.php` (classe générique)

### 3. **Vues Email (Blade)**
Templates HTML élégants avec design Noir & Or.

**Fichiers:**
- `resources/views/emails/admin-notification-message.blade.php`
- `resources/views/emails/admin-notification-quote.blade.php`
- `resources/views/emails/admin-notification-comment.blade.php`

## 🎨 Design des Emails

### Palette de Couleurs
- **Noir Premium:** `#1a1a1a` (Fond principal)
- **Or Élégant:** `#d4af37` (Accents & CTA)
- **Or Clair:** `#f4e5c3` (Dégradés)

### Éléments du Design
- ✅ Header avec dégradé noir → or
- ✅ Barre accent or en haut
- ✅ Sections avec bordure or
- ✅ Bouton CTA or avec ombre
- ✅ Footer noir avec or

## 📧 Flux d'Envoi

### Pour un Nouveau Message

```
Client soumet un message
    ↓
MessageObserver créé (created event)
    ↓
Try/Catch lancé
    ↓
Email créé (NewMessageNotificationMail)
    ↓
Vue admin-notification-message.blade.php rendue
    ↓
Email mis en queue (file d'attente de job)
    ↓
Queue worker traite l'email
    ↓
Email envoyé via SMTP à cynthiankwete@gmail.com
    ↓
Cynthia reçoit une notification élégante avec lien d'action
```

**Pour les autres types:**
- Devis → `NewQuoteRequestNotificationMail` → `admin-notification-quote.blade.php`
- Commentaire → `NewCommentNotificationMail` → `admin-notification-comment.blade.php`

## 🛡️ Gestion des Erreurs

### Try/Catch dans les Observers
```php
try {
    Mail::to($adminEmail)->send(new NewMessageNotificationMail($message));
} catch (\Exception $e) {
    \Log::error('Erreur lors de l\'envoi...', [
        'error' => $e->getMessage(),
        'message_id' => $message->id,
    ]);
}
```

**Avantages:**
- ✅ Les erreurs SMTP ne cassent pas le site (pas de 500 error)
- ✅ Logs enregistrées pour debug
- ✅ L'utilisateur peut soumettre son contenu sans problème
- ✅ L'email sera retenté plus tard par le queue worker

## ⚙️ Configuration

### Variables d'Environnement

```env
# .env
ADMIN_EMAIL=cynthiankwete@gmail.com

# SMTP (voir DEPLOYMENT_HOSTINGER.md)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=support@votre-domaine.com
MAIL_PASSWORD=votre-mot-de-passe
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=support@votre-domaine.com
MAIL_FROM_NAME=CK Agency

# Queue
QUEUE_CONNECTION=database
```

### Configuration dans config/app.php

```php
'admin_email' => env('ADMIN_EMAIL', 'cynthiankwete@gmail.com'),
```

## 🚀 Déploiement

### Sur Hostinger

1. **Configuration SMTP**
   - Obtenir les paramètres de Hostinger
   - Configurer dans `.env`

2. **Queue Worker**
   - Ajouter tâche cron pour lancer le worker:
   ```bash
   * * * * * cd /home/user/public_html && php artisan queue:work --max-jobs=1000 --max-time=3600 >> /dev/null 2>&1
   ```

3. **Tester**
   ```bash
   # Créer un test email
   php artisan tinker
   Mail::raw('test', function($m) { $m->to('cynthia@example.com')->subject('Test'); });
   
   # Voir les jobs en queue
   php artisan queue:failed
   
   # Exécuter un job unique
   php artisan queue:work --once
   ```

## 📋 Contenu des Emails

### Email Message (Nouveau Message)
- ✅ Nom du client
- ✅ Email & téléphone
- ✅ Sujet
- ✅ Aperçu du message (500 caractères max)
- ✅ Bouton "Voir dans l'administration" → Edit page Filament

### Email QuoteRequest (Nouveau Devis)
- ✅ Nom du client
- ✅ Email & téléphone
- ✅ **Budget** (clé pour l'affaire)
- ✅ Services demandés
- ✅ Lieu de l'événement
- ✅ Date de l'événement
- ✅ Bouton d'action vers Filament

### Email Comment (Nouveau Commentaire)
- ✅ Auteur du commentaire
- ✅ Article/Événement commenté
- ✅ Contenu du commentaire
- ✅ Statut d'approbation
- ✅ Bouton de modération

## 🔍 Dépannage

### Les emails ne s'envoient pas

1. **Vérifier les logs**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Vérifier la queue**
   ```bash
   php artisan queue:failed  # Voir les jobs échoués
   ```

3. **Vérifier le worker**
   ```bash
   ps aux | grep queue  # Voir si le worker s'exécute
   ```

4. **Tester la connexion SMTP**
   ```bash
   telnet smtp.hostinger.com 465
   ```

### Les jobs restent en attente

- Vérifier que le cron worker s'exécute
- Vérifier les permissions du dossier storage
- Vérifier PHP CLI est disponible

## 📞 Support

Consultez `DEPLOYMENT_HOSTINGER.md` pour la configuration détaillée sur Hostinger.

---

**Système mis à jour:** 20 février 2026  
**Design:** Noir & Or Premium  
**Email Admin:** cynthiankwete@gmail.com
