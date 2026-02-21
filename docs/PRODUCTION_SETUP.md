# 🚀 Guide de Déploiement & Initialisation en Production

> **Version**: 1.0  
> **Projet**: CK Agency  
> **Date**: Février 2026

---

## 📋 Table des matières

1. [Prérequis](#prérequis)
2. [Initialisation de la Base de Données](#initialisation-de-la-base-de-données)
3. [Déploiement sur Hostinger](#déploiement-sur-hostinger)
4. [Configuration Post-Déploiement](#configuration-post-déploiement)
5. [Vérifications Importantes](#vérifications-importantes)
6. [Maintenance Régulière](#maintenance-régulière)

---

## Prérequis

Avant de démarrer, assurez-vous d'avoir :

- ✅ PHP 8.1 ou supérieur
- ✅ Composer installé
- ✅ Node.js & npm (pour les assets)
- ✅ Accès base de données (MySQL 8.0+)
- ✅ Compte Hostinger (ou hébergeur compatible)
- ✅ Domaine configuré (ckagency.com)

---

## Initialisation de la Base de Données

### Étape 1 : Installation des Dépendances

```bash
# Si vous êtes en clonage du repo
composer install

# Installation des dépendances Node
npm install
```

### Étape 2 : Configuration de l'Environnement

Créez un fichier `.env` ou copiez `.env.example` :

```bash
cp .env.example .env
```

Configurez les variables minimales :

```env
# Base de Données
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=ck_agency_prod
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u842981853_ck_db
DB_USERNAME=u842981853_ck_admin
DB_PASSWORD=OnWVfX2;Ep

# Application
APP_NAME="CK Agency"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ckagency.com

# Mail
MAIL_MAILER=smtp
MAIL_HOST=votre_smtp_hostinger
MAIL_PORT=587
MAIL_USERNAME=noreply@ckagency.com
MAIL_PASSWORD=votre_mot_de_passe_email

# Cache & Sessions
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Étape 3 : Générer la Clé d'Application

```bash
php artisan key:generate
```

### Étape 4 : Exécuter les Migrations

```bash
# Créer les tables dans la base de données
php artisan migrate --force
```

**⚠️ En production, utilisez `--force` pour confirmer l'exécution**

### Étape 5 : Exécuter les Seeders

```bash
# Seeder tous les paramétrages initiaux
php artisan db:seed
```

Ou seul celui de la base :

```bash
php artisan db:seed --class=DatabaseSeeder
```

**✓ Cela créera** :
- ✅ Utilisateur admin (email: admin@ckevent.com)
- ✅ Paramètres généraux (contact, SEO, email)
- ✅ Catégories d'articles (8 catégories)
- ✅ Types d'événements (10 types)
- ✅ Parcours de Cynthia (5 étapes)
- ✅ Pages statiques (about, services, mentions légales, politique confidentialité)

### Étape 6 : Compiler les Assets

```bash
npm run build
```

Pour le mode développement (avec hot reload) :

```bash
npm run dev
```

### Étape 7 : Optimiser pour la Production

```bash
# Cache les configurations
php artisan config:cache

# Cache les routes
php artisan route:cache

# Cache les vues
php artisan view:cache

# Optimise l'autoload
composer install --optimize-autoloader --no-dev

# Duplique les fichiers de configuration
php artisan optimize
```

---

## Déploiement sur Hostinger

### Via Hostinger Control Panel

#### Étape 1 : Préparation des Fichiers

1. Compressez le projet (sans `node_modules` et `vendor` si possible)
2. Compressez séparément `vendor/` (pour upload séparé si besoin)

#### Étape 2 : Upload des Fichiers

1. Allez sur **Hostinger cPanel**
2. Allez dans **File Manager**
3. Naviguez vers `/public_html`
4. Téléchargez tous les fichiers du projet
5. Décompressez l'archive

#### Étape 3 : Configuration du Domaine

1. Allez dans **Domains** (Hostinger cPanel)
2. Sélectionnez `ckagency.com`
3. Pointez vers `/public_html`

#### Étape 4 : Base de Données

1. Allez dans **MySQL Databases**
2. Créez une nouvelle BD: `ck_agency_prod`
3. Créez un utilisateur MySQL
4. Notez les identifiants

#### Étape 5 : SSL Certificate

1. Allez dans **SSL Manager**
2. Activez **Auto-Renew** si disponible
3. Ou installez un certificat gratuit (Let's Encrypt)

### Via SSH (Déploiement Avancé)

Si vous avez accès SSH :

```bash
# Connectez-vous au serveur
ssh user@your_hostinger_server.com

# Naviguez dans le répertoire public
cd ~/public_html

# Clonez le repo ou uploadez
git clone https://github.com/your-repo/ck-agency.git .

# Installez les dépendances
composer install --optimize-autoloader --no-dev

# Compilez les assets
npm ci && npm run build

# Configuration de l'environnement
cp .env.example .env
php artisan key:generate

# Permissions des fichiers
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Migrations et seeders
php artisan migrate --force
php artisan db:seed --force

# Cache pour production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart queue (si utilisé)
supervisorctl restart ck-agency
```

---

## Configuration Post-Déploiement

### 1. Vérifier la Connexion Admin

```
URL: https://ckagency.com/admin
Email: admin@ckevent.com
Password: cynthia@123
```

**✅ À faire immédiatement** :
- [ ] Changez le mot de passe admin
- [ ] Vérifiez que vous pouvez vous connecter

### 2. Vérifier les Paramètres

Allez dans **Admin** → **Configuration** → **Paramètres**

Vérifiez que les paramètres suivants sont corrects :

```
- site_name: "CK Agency" ✓
- contact_email: cynthiankwete@gmail.com ✓
- contact_phone: +237 654 81 12 69 ✓
- site_url: https://ckagency.com ✓
- mail_notification_enabled: true ✓
```

### 3. Tester l'Envoi d'Email

Allez dans le formulaire de contact du site et envoyez un test :

```
- Vérifiez que vous recevez l'email
- Vérifiez le contenu du message
```

### 4. Vérifier le SEO

1. Vérifiez que les metas sont présentes dans le code source
2. Testez avec les outils Google :
   - Google Search Console
   - Google PageSpeed Insights

### 5. Vérifier les Assets Statiques

- Logo du site ✓
- Favicon ✓
- CSS & JS chargés ✓
- Images optimisées ✓

### 6. Configurer les Sauvegardes

1. Allez dans **Hosting** → **Backups** (Hostinger)
2. Activez les sauvegardes automatiques quotidiennes
3. Conservez au minimum 2 semaines de backups

---

## Vérifications Importantes

### Checklist de Déploiement

```
PRÉ-DÉPLOIEMENT:
□ Migrations testées localement
□ Seeders testés localement
□ Variables .env configurées
□ SSL certificat prêt
□ Domaine pointant vers le serveur

DÉPLOIEMENT:
□ Fichiers uploadés correctement
□ Permissions fichiers/dossiers (755/775)
□ Base de données créée
□ Migrations exécutées
□ Seeders exécutés
□ Assets compilés

POST-DÉPLOIEMENT:
□ Admin accessible
□ Email notifications fonctionnel
□ SEO vérifié
□ Sauvegardes activées
□ HTTPS forcé
□ Cookies GDPR vérifiés
□ Performance optimale
```

### Commandes de Diagnostic

```bash
# Vérifier l'état général
php artisan about

# Vérifier les migrations
php artisan migrate:status

# Vérifier les logs
tail -f storage/logs/laravel.log

# Vérifier les permissions
ls -la storage/
ls -la bootstrap/cache/

# Vérifier la base de données
php artisan tinker
>>> DB::connection()->getPdo()

# Vérifier les emails
php artisan tinker
>>> Mail::to('test@example.com')->send(new TestMail());
```

---

## Maintenance Régulière

### Quotidien (Automatisé)

```bash
# Crons configuration (dans .env)
APP_MAINTENANCE_WINDOW="0 2 * * *"  # 2h du matin

# Nettoyage cache
php artisan cache:clear
php artisan view:clear
```

### Hebdomadaire

- [ ] Vérifier les logs (storage/logs/)
- [ ] Exporter les stats (messages, newsletter)
- [ ] Vérifier les emails non envoyés

### Mensuel

- [ ] Sauvegarder la base de données
- [ ] Vérifier l'espace disque disponible
- [ ] Mettre à jour les packages si nécessaire
- [ ] Vérifier le ranking SEO

### Trimestriel

- [ ] Audit de sécurité
- [ ] Mise à jour des dépendances
- [ ] Optimisation des images
- [ ] Vérification des liens cassés

### Commandes de Maintenance Utiles

```bash
# Nettoyage global
php artisan optimize:clear

# Nettoyage des logs anciens
php artisan tinker
>>> Storage::disk('logs')->delete([...]) // Supprimer les vieux logs

# Réparation de la base de données
php artisan db:seed --class=DatabaseSeeder --force  # Re-seed si erreur

# Mise à jour de Composer
composer update

# Vérifier les mises à jour
composer outdated
npm outdated
```

---

## Dépannage Courant

### ❌ Erreur: "Base de données non accessible"

```bash
# Vérifiez le fichier .env
cat .env | grep DB_

# Vérifiez la connexion
php artisan tinker
>>> DB::connection()->getPdo()
```

### ❌ Erreur: "APP_KEY not set"

```bash
php artisan key:generate
php artisan config:cache
```

### ❌ Erreur: "Permissions denied" sur storage/

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### ❌ Emails ne s'envoient pas

1. Vérifiez MAIL_* dans .env
2. Testez avec une commande tinker
3. Vérifiez les logs (storage/logs/laravel.log)

### ❌ Assets CSS/JS décalés

```bash
# Re-compilez les assets
npm run build

# Videz le cache du navigateur (Ctrl+Shift+Del)
```

---

## Support & Ressources

### Documentation

- [Laravel Docs](https://laravel.com/docs)
- [Filament Documentation](https://filamentadmin.com)
- [Hostinger Support](https://support.hostinger.com)

### Contact Support Projet

- **Email**: cynthiankwete@gmail.com
- **Téléphone**: +237 654 81 12 69
- **Heure**: Lun-Ven, 09:00-18:00 (Heure Cameroun)

---

## Variables d'Environnement Essentielles

```env
# Application
APP_NAME=CK Agency
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ckagency.com
APP_TIMEZONE=Africa/Douala

# Base de données
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=ck_agency_prod
DB_USERNAME=ck_user
DB_PASSWORD=securepassword123

# Cache & Sessions
CACHE_DRIVER=file
CACHE_STORE=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_CONNECTION=sync

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=noreply@ckagency.com
MAIL_PASSWORD=yourpassword
MAIL_FROM_ADDRESS=noreply@ckagency.com
MAIL_FROM_NAME="CK Agency"

# Logs
LOG_CHANNEL=single
LOG_LEVEL=info

# Sécurité
FORCE_HTTPS=true
SESSION_SECURE_COOKIES=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

---

**Dernière mise à jour**: 21 Février 2026  
**Statut**: Prêt pour production ✅  
**Version**: 1.0

