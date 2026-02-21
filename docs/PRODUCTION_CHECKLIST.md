# ✅ Checklist Final Production - CK Agency

**Version**: 1.0 | **Date**: Février 2026 | **Responsable**: Cynthia Kenne

---

## 📦 PRÉPARATION (1-2 jours avant)

### Code & Environnement
- [ ] Cloner/télécharger le dernier code
- [ ] Vérifier que `.env.example` est à jour
- [ ] Tester localement: `php artisan serve`
- [ ] Exécuter les migrations localement: `php artisan migrate`
- [ ] Exécuter les seeders localement: `php artisan db:seed`
- [ ] Compiler les assets: `npm run build`
- [ ] Vérifier aucun erreur: `php artisan about`

### Documentation
- [ ] Lire le guide PRODUCTION_SETUP.md
- [ ] Préparer les identifiants d'accès sécurisés
- [ ] Avoir le contact Hostinger à portée de main
- [ ] Backup du .env local (sauf en production)

### Données Initiales
- [ ] ✅ SettingsSeeder créé avec données réelles
- [ ] ✅ CategorySeeder créé (8 catégories)
- [ ] ✅ EventTypeSeeder créé (10 types)
- [ ] ✅ DatabaseSeeder mis à jour
- [ ] ✅ JourneySeeder (parcours Cynthia)
- [ ] ✅ PageSeeder (pages statiques)

---

## 🚀 DÉPLOIEMENT (Jour J - Matin)

### Préparation Hostinger
- [ ] Accès Hostinger cPanel disponible
- [ ] Domaine `ckagency.com` pointing vers `/public_html`
- [ ] Base de données MySQL `ck_agency_prod` créée
- [ ] Utilisateur MySQL créé: `ck_user`
- [ ] SSL Certificate (Let's Encrypt) installé

### Upload des Fichiers
- [ ] Compresser le projet (sans `/node_modules`, `/vendor`)
- [ ] Créer `.env` sur le serveur (copier depuis `.env.example`)
- [ ] Uploader `/vendor` (si upload séparé nécessaire)
- [ ] Uploader le reste du code
- [ ] Décompresser les archives

### Configuration Serveur
- [ ] Permissions fichiers: `chmod 755 -R .`
- [ ] Permissions dossiers: `chmod 775 -R storage bootstrap/cache`
- [ ] Variables `.env` mises à jour (copie depuis local)
- [ ] Clé d'application : `php artisan key:generate`

### Exécution des Migrations & Seeders (IMPORTANT!)
```bash
# 1. Migrations
php artisan migrate --force

# 2. Seeders (initialisation des données)
php artisan db:seed --force

# Output attendu:
# ✓ Paramètres généraux configurés avec succès
# ✓ Catégories d'articles créées avec succès
# ✓ Types d'événements créés avec succès
# ✓ Création du parcours de Cynthia...
# ✓ Création des Pages statiques...
```

### Optimisation Production
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`
- [ ] `composer install --optimize-autoloader --no-dev`
- [ ] `npm run build`

---

## ✔️ TESTS IMMÉDIATS (Jour J - Midi)

### Accès Admin
- [ ] URL: `https://ckagency.com/admin` accessible
- [ ] Login avec: `admin@ckevent.com` / `cynthia@123`
- [ ] ✅ Vous êtes connectée au Dashboard
- [ ] Changedez le mot de passe admin **IMMÉDIATEMENT**

### Vérification Données
- [ ] Settings: `Configuration` → `Paramètres`
  - [ ] `site_name` = "CK Agency"
  - [ ] `contact_email` = "cynthiankwete@gmail.com"
  - [ ] `contact_phone` = "+237 654 81 12 69"
  - [ ] `owner_name` = "Cynthia Kenne"
  - [ ] Social Facebook = https://www.facebook.com/cynthia.kenne.9

- [ ] Categories: `Contenu` → `Catégories`
  - [ ] 8 catégories visibles
  - [ ] Catégories actives (checkmark vert)

- [ ] Event Types: `Événements` → `Types d'Événements`
  - [ ] 10 types d'événements créés
  - [ ] Chaque type a une couleur et une icône

- [ ] Pages: `Contenu` → `Pages Statiques`
  - [ ] About: "Cynthia Kenne : Une vocation au service de l'impact"
  - [ ] Services: "CK EVENT" et "CK INFOS+" visibles
  - [ ] Mentions Légales: complètes
  - [ ] Politique Confidentialité: complète

### Affichage Frontend
- [ ] Page d'accueil se charge correctement
- [ ] Logo du site visible
- [ ] Menu fonctionne
- [ ] Lien "À propos" → Page about chargée
- [ ] Formulaire de contact fonctionnel
- [ ] Newsletter abonnement fonctionne
- [ ] Responsive (mobile, tablette, desktop)

### Emails
- [ ] Tester formulaire contact (vous devez recevoir un email)
- [ ] Email show name "CK Agency"
- [ ] Email address from: `mail_from_address`
- [ ] Réponse auto-reply fonctionne

### Performance
- [ ] Page load time < 3 secondes
- [ ] Mobile friendly: Google Mobile-Friendly Test ✅
- [ ] Lighthouse score > 80

---

## 🔒 SÉCURITÉ (Jour J - Après-midi)

### Authentification
- [ ] Password admin changé ✅
- [ ] Remeber me fonctionne
- [ ] Logout fonctionne
- [ ] Sessions expiration après 120min

### HTTPS/SSL
- [ ] Certificat SSL valide (vérifier barre verte 🔒)
- [ ] URL redirection HTTP → HTTPS (visitez http://ckagency.com)
- [ ] Certificat valable jusqu'à: _____ (vérifier date expiration)

### Variables Sensibles
- [ ] `APP_DEBUG = false` (jamais `true` en production)
- [ ] `APP_ENV = production`
- [ ] `.env` jamais uploadé publiquement
- [ ] Database password changée (non `root`)
- [ ] Mail password sécurisé

### Sauvegarde
- [ ] Hostinger backups activés (quotidien)
- [ ] Première sauvegarde manuelle faite (download)
- [ ] Stockée en lieu sûr

---

## 📊 SEO & ANALYTICS (Jour J - Fin)

### Google Search Console
- [ ] Compte GSC créé/configuré
- [ ] Propriété ajoutée: `ckagency.com`
- [ ] Sitemap soumis: `/sitemap.xml`
- [ ] Copy de vérification: Balise meta ou DNS

### Google Analytics (optionnel)
- [ ] GA ID configuré (si utilisation)
- [ ] Testing: événement trackage fonctionne

### Meta Tags
- [ ] Title tag: "CK Agency - Communication & Expertise"
- [ ] Meta description: présente et pertinente
- [ ] Meta keywords: présents
- [ ] Open Graph: image partage Facebook correcte
- [ ] Twitter Card: image visible en partage Twitter

### Robots.txt & Sitemap
- [ ] `/robots.txt` existe: `public/robots.txt`
- [ ] `/sitemap.xml` existe: auto-généré par Laravel
- [ ] Aucun désallowed sur `/admin`

---

## 📱 CROSS-BROWSER & DEVICE

### Desktop
- [ ] Chrome ✅
- [ ] Firefox ✅
- [ ] Safari ✅
- [ ] Edge ✅

### Mobile
- [ ] iPhone (Safari) ✅
- [ ] Android (Chrome) ✅
- [ ] Responsive design ✅
- [ ] Touch events fonctionne ✅

### Tablette
- [ ] iPad ✅
- [ ] Android Tablet ✅

---

## 📧 FORMULAIRES & COMMUNICATIONS

### Contact Form
- [ ] Formulaire accessible
- [ ] Validation: champs obligatoires
- [ ] Email envoyé à l'admin
- [ ] Confirmation reçue au client
- [ ] Pas de spam (honeypot actif)

### Quote Request
- [ ] Formulaire devis accessible
- [ ] Email reçu avec détails
- [ ] Admin peut répondre via admin panel

### Newsletter
- [ ] Box newsletter visible
- [ ] Abonnement fonctionne
- [ ] Confirmation email envoyée
- [ ] Email admin notifié

### Admin Notifications
- [ ] Vous recevez notifications:
  - [ ] Nouveaux messages
  - [ ] Nouvelles demandes devis
  - [ ] Nouveaux abonnés newsletter

---

## 🎨 CONTENU & DESIGN

### Images
- [ ] Logo chargé correctement
- [ ] Favicon visible (onglet navigateur)
- [ ] Favicon mobile (Apple touch icon)
- [ ] Toutes images optimisées (< 500KB)
- [ ] Alt text présent sur toutes images

### Typographie
- [ ] Police correcte (Google Fonts chargée)
- [ ] Lisibilité adéquate
- [ ] Contraste bon (WCAG AA)

### Couleurs Brand
- [ ] Couleur primaire: or/bronze #C9A961
- [ ] Accent couleur: appliquée
- [ ] Cohérence avec maquettes

---

## 📱 SOCIAL MEDIA LINKS

- [ ] Facebook link correct: https://www.facebook.com/cynthia.kenne.9
- [ ] Facebook page visible: https://www.facebook.com/ckagency
- [ ] Links ouvrent dans new tab
- [ ] Partage article fonctionne

---

## ⚠️ ERREURS COURANTES À VÉRIFIER

- [ ] ❌ APP_DEBUG n'est PAS true
- [ ] ❌ Base de données ne montre pas erreurs de connexion
- [ ] ❌ 404 errors console (tous les assets chargés)
- [ ] ❌ CORS errors (si appels API externes)
- [ ] ❌ White screen of death (check logs)
- [ ] ❌ Mails non envoyés (check MAIL_* variables)

---

## 🎯 GO LIVE (Jour+1 - Matin)

### Dernières Vérifications
- [ ] Tous les points précédents ✅
- [ ] Aucun erreur dans logs: `storage/logs/`
- [ ] Backup récent pris
- [ ] Admin dashboard accessible
- [ ] Données seedées visibles

### Communication
- [ ] Email d'annonce lancé (newsletter)
- [ ] Post Facebook du lancement
- [ ] Message client/partenaires: site new live

### Monitoring 24h
- [ ] Vérifier logs quotidiennement
- [ ] Répondre rapidement aux messages
- [ ] Monitoring performance
- [ ] Réagir en cas d'bug

---

## 📋 POST-LANCEMENT (Semaine 1)

### Monitoring
- [ ] Site accès stable ✅
- [ ] Emails envoyent correctement ✅
- [ ] DB backups s'exécutent ✅
- [ ] Pas d'erreurs runtime ✅

### SEO Initial
- [ ] Google a crawlé le site (Search Console)
- [ ] Au minimum 1st page indexée
- [ ] Google Images indexe les photos

### Contenu Initial
- [ ] 1ère article publié
- [ ] 1er événement portfolio ajouté
- [ ] Quelques photos partenaires

### Engagement
- [ ] 1ers abonnés newsletter (minimum 5)
- [ ] Messages de test répondus
- [ ] Demandes devis reçues et traitées

---

## 📊 STATISTIQUES À TRACKER (Jour+7)

Documenter dans un fichier (tracking.txt):

```
Date: _______________
URL: https://ckagency.com

TRAFIC:
- Visiteurs: ___
- Pages vues: ___
- Bounce rate: ___%
- Avg session: __s

CONVERSIONS:
- Messages formulaire: __
- Abonnés newsletter: __
- Demandes devis: __

TECHNISCHE:
- Page load time: __s
- Uptime: ___%
- Erreurs logs: __
```

---

## 🔧 CONTACTS D'URGENCE

| Service | Contact | Priorité |
|---------|---------|----------|
| Hostinger Support | support@hostinger.com | 🔴 Critique |
| Domain Registry | registrar@domain.com | 🟡 Important |
| Email Support | mail-support@hostinger | 🟠 Moyen |
| SSL Support | ssl@hostinger.com | 🟠 Moyen |

---

## ✨ NOTES FINALES

1. **Pas de panique** - Si bug, vérifiez d'abord les logs
2. **Testez tout** - Mieux vaux tester 10x avant le lancement
3. **Documentez** - Notez tous les problèmes rencontrés
4. **Backups** - Faites au minimum 2 backups avant GO LIVE
5. **Responsif** - Testez absolument sur mobile

---

## 🎉 LANCEZ! 

Une fois tous les points vérifiés ✅, vous êtes prêts !

**Status du Lancement**: ☐ Pas prêt | ☐ PRÊT À LANCER 🚀

**Date Lancement Confirmée**: ___________________

**Signé par**: _________________________ Date: __________

---

**Rappel**: Consultez `docs/ADMIN_GUIDE.md` pour l'utilisation quotidienne et `docs/PRODUCTION_SETUP.md` pour le dépannage.

