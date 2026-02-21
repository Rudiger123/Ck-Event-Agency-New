# Guide de Déploiement sur Hostinger

## Configuration pour Hostinger Premium

Ce guide couvre la configuration complète des notifications par email et de la queue pour un fonctionnement optimal des newsletters sur Hostinger.

### ⚙️ Configuration du Fichier .env

Accédez à votre fichier `.env` sur Hostinger et configurez ces paramètres:

#### 1. **Application Générale**
```env
APP_ENV=production    # Mode production
APP_DEBUG=false       # Désactiver le debug en production
APP_URL=https://votre-domaine.com  # Votre domaine avec HTTPS
```

#### 2. **Base de Données**
```env
DB_CONNECTION=mysql
DB_HOST=localhost     # Fourni par Hostinger
DB_PORT=3306
DB_DATABASE=votre_bdd
DB_USERNAME=votre_user
DB_PASSWORD=votre_pass
```

#### 3. **Configuration SMTP (IMPORTANT pour les notifications)**

**Option A - SMTP fourni par Hostinger:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465          # ou 587
MAIL_USERNAME=support@votre-domaine.com
MAIL_PASSWORD=votre_mdp_email
MAIL_ENCRYPTION=ssl    # ou tls
MAIL_FROM_ADDRESS=support@votre-domaine.com
MAIL_FROM_NAME="CK Agency"
```

**Option B - Sendmail système (si disponible):**
```env
MAIL_MAILER=sendmail
MAIL_SENDMAIL_PATH="/usr/sbin/sendmail -bs -i"
MAIL_FROM_ADDRESS=support@votre-domaine.com
MAIL_FROM_NAME="CK Agency"
```

#### 4. **Configuration de la Queue (pour les newsletters)**
```env
QUEUE_CONNECTION=database
# Laissez les autres paramètres par défaut
```

### 🚀 Étapes de Déploiement

#### 1. **Avant le Déploiement (Local)**
```bash
# Générer la clé d'application
php artisan key:generate

# Créer le fichier de cache config
php artisan config:cache

# Compiler les assets
npm run build
```

#### 2. **Sur Hostinger (via FTP/SSH)**

- Uploader tous les fichiers du projet
- **NE PAS uploader:** 
  - `/node_modules`
  - `/vendor` (installer via composer après)
  - `.env` (créer directement sur le serveur)
  - `.git`

#### 3. **Installation des Dépendances**

```bash
# SSH sur Hostinger
composer install --optimize-autoloader --no-dev

# Générer la clé (si pas fait localement)
php artisan key:generate

# Exécuter les migrations
php artisan migrate --force
```

#### 4. **Configuration des Permissions**
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### 📧 Points Importants pour les Notifications

#### **La Queue Worker est CRITIQUE**

Pour que les emails soient réellement envoyés, vous AVEZ BESOIN d'un worker de queue actif.

**Hostinger Premium offre:**
- ✅ Support SSH
- ✅ Support Cron
- ✅ Support PHP CLI

**Solution 1: Cron Worker (Recommandé)**

Ajoutez cette tâche Cron dans Hostinger (cPanel):
```bash
* * * * * cd /home/votre-user/public_html && php artisan queue:work --max-jobs=1000 --max-time=3600 >> /dev/null 2>&1
```

Configurez le cron pour qu'il s'exécute **chaque minute** et il relancera le worker toutes les heures.

**Solution 2: Supervisor (si disponible)**

Demandez à Hostinger s'ils supportent Supervisor pour une gestion meilleure du worker.

### 🧪 Tests après Déploiement

1. **Test de l'Email:**
```bash
php artisan tinker
Mail::raw('Test', function($msg) {
  $msg->to('votre@email.com')
      ->subject('Test Email');
});
```

2. **Test de la Queue:**
```bash
php artisan queue:failed        # Voir les jobs échoués
php artisan queue:retry all      # Réessayer les jobs échoués
php artisan queue:work --once   # Exécuter un job unique pour tester
```

3. **Test du Système Complet:**
- Créer une newsletter de test
- Cliquer sur "Envoyer"
- Vérifier les logs: `tail -f storage/logs/laravel.log`

### 📋 Checklist Finale

- [ ] Fichier `.env` correctement configuré
- [ ] SMTP testé et fonctionnel
- [ ] Migrations exécutées
- [ ] Permissions des dossiers correctes
- [ ] Cron worker configuré
- [ ] Permissions du cron vérifiées
- [ ] Test email envoyé avec succès
- [ ] Newsletter de test envoyée

### 🔍 Dépannage Courant

**Symptôme:** Les emails ne sont pas envoyés
- ✓ Vérifier `storage/logs/laravel.log` pour les erreurs
- ✓ Vérifier la table `jobs` pour voir les jobs en queue
- ✓ Vérifier que le cron worker s'exécute: `ps aux | grep queue`
- ✓ Tester la connexion SMTP avec telnet

**Symptôme:** Erreur "Connection refused"
- ✓ Vérifier le MAIL_HOST et MAIL_PORT
- ✓ Vérifier credentials SMTP
- ✓ Hostinger peut bloquer certains ports - demander support

**Symptôme:** Les newsletters restent "draft"
- ✓ Vérifier qu'il existe des abonnés confirmés
- ✓ Vérifier les logs pour les erreurs

### 📞 Support Hostinger

Contactez le support Hostinger pour:
- Confirmer les paramètres SMTP
- Vérifier le support PHP CLI pour cron
- Demander les ports autorisés pour les emails

---

**Note:** Hostinger Premium devrait supporter tout cela. Si vous avez des problèmes, leur support est généralement réactif.
