# 📋 Guide Complet d'Utilisation - Interface Administrateur

> **Version**: 1.0  
> **Date**: Février 2026  
> **Responsable**: Cynthia Kenne - CK Agency

---

## 📑 Table des matières

1. [Accès à l'Interface Admin](#accès-à-linterface-admin)
2. [Vue d'ensemble du Tableau de Bord](#vue-densemble-du-tableau-de-bord)
3. [Gestion des Paramètres](#gestion-des-paramètres)
4. [Gestion des Articles & Blog](#gestion-des-articles--blog)
5. [Gestion du Portfolio (Événements)](#gestion-du-portfolio-événements)
6. [Gestion des Utilisateurs](#gestion-des-utilisateurs)
7. [Gestion des Messages & Demandes](#gestion-des-messages--demandes)
8. [Gestion des Partenaires](#gestion-des-partenaires)
9. [Gestion de la Newsletter](#gestion-de-la-newsletter)
10. [Configuration SEO](#configuration-seo)
11. [Tips & Bonnes Pratiques](#tips--bonnes-pratiques)

---

## Accès à l'Interface Admin

### URL d'Accès
```
https://ckagency.com/admin
```

### Identifiants de Connexion
- **Email** : `admin@ckevent.com`
- **Mot de passe** : Voir les identifiants sécurisés

### ⚠️ Recommandations de Sécurité

1. **Changez votre mot de passe** dès votre première connexion
   - Menu Profil (en haut à droite) → Paramètres du compte → Modifier le mot de passe

2. **Gardez votre accès confidentiel** - Ne le partagez jamais

3. **Déconnexion après utilisation** - Cliquez sur votre profil → Déconnexion

4. **Changement régulier de mot de passe** - Recommandé tous les 3 mois

---

## Vue d'ensemble du Tableau de Bord

### Widgets Principaux (Accueil Admin)

| Widget | Fonction |
|--------|----------|
| **Statistiques Sites** | Affiche les nombres de: Articles, Événements, Messages |
| **Activité Récente** | Liste des 5 dernières actions effectuées |
| **Messages Non Lus** | Nombre de demandes de contact en attente |
| **Événements à Venir** | Portfolio d'événements programmés |

### Navigation Principale (Barre Latérale)

```
📊 Dashboard
  └─ Accueil & Statistiques

📝 Contenu
  ├─ Articles
  ├─ Catégories
  ├─ Pages Statiques
  └─ Commentaires

🎪 Événements
  ├─ Événements (Portfolio)
  ├─ Types d'Événements
  └─ Galerie Média

💼 Entreprise
  ├─ Partenaires
  ├─ Testimoniaux
  └─ Parcours (Journey)

📨 Communication
  ├─ Messages
  ├─ Demandes de Devis
  ├─ Newsletter (Abonnés)
  └─ Notifications

⚙️ Configuration
  ├─ Paramètres
  ├─ Utilisateurs
  └─ Rôles & Permissions
```

---

## Gestion des Paramètres

### Accés
**Barre latérale** → **Configuration** → **Paramètres**

### Vue d'ensemble

Les paramètres sont organisés par **groupes** :

#### 1️⃣ **Paramètres Généraux** (Groupe: General)
- `site_name` : Nom du site → **"CK Agency"**
- `site_tagline` : Slogan → **"Communication & Knowledge"**
- `site_description` : Métadescription du site
- Logos (dark/light/favicon)

**✏️ À modifier régulièrement selon vos besoins**

#### 2️⃣ **Informations de Contact** (Groupe: Contact)
- `contact_email` : Email principal
- `contact_phone` : Numéro de téléphone principal
- `contact_location` : Localisation (Dschang, Cameroun)
- `contact_timezone` : Fuseau horaire (Africa/Douala)

**✏️ Garder à jour pour que vos clients vous contactent facilement**

```
Exemple:
Email: cynthiankwete@gmail.com
Tél: +237 654 81 12 69
Lieu: Dschang, Menoua, Cameroun
```

#### 3️⃣ **Réseaux Sociaux** (Groupe: Social)
- `social_facebook` : URL profil personnel
- `social_facebook_page` : URL page d'entreprise
- `social_instagram`, `social_linkedin`, `social_youtube`, `social_twitter`

**✏️ Mettez vos liens pour que les visiteurs vous retrouvent**

```
Facebook: https://www.facebook.com/cynthia.kenne.9
Facebook Page: https://www.facebook.com/ckagency
```

#### 4️⃣ **Propriétaire/Directrice** (Groupe: Owner)
- `owner_name` : Nom → **"Cynthia Kenne"**
- `owner_title` : Titre → **"Directrice & Fondatrice"**
- `owner_bio` : Biographie courte
- `owner_email`, `owner_phone`, `owner_facebook`

**✏️ À adapter si besoin**

#### 5️⃣ **Configuration Email** (Groupe: Email)
- `mail_from_address` : Email d'envoi des notifications
- `mail_from_name` : Nom expéditeur
- `mail_admin_address` : Où recevoir les notifications
- `mail_notification_enabled` : Activer/Désactiver les notifications

**✏️ À configurer correctement pour recevoir les messages**

#### 6️⃣ **Configuration Web** (Groupe: Website)
- `site_url` : URL du site
- `site_language` : Langue par défaut → **"fr" (français)**
- `site_maintenance_mode` : Passer le site en maintenance
- `blog_posts_per_page` : Articles affichés par page (défaut: 12)
- `portfolio_items_per_page` : Événements affichés par page (défaut: 9)

#### 7️⃣ **SEO** (Groupe: SEO)
- `seo_meta_keywords` : Mots-clés pour le référencement
- `seo_meta_author` : Auteur du site
- `google_analytics_id` : ID Google Analytics (optionnel)

#### 8️⃣ **Marketing** (Groupe: Marketing)
- `newsletter_enabled` : Activer la newsletter
- `contact_form_enabled` : Formulaire de contact
- `quote_request_enabled` : Demandes de devis
- `comments_enabled` : Commentaires sur articles

### Comment Modifier un Paramètre

1. Allez dans **Configuration** → **Paramètres**
2. Cherchez le paramètre avec la **barre de recherche**
3. Cliquez sur le **crayon (✏️) pour éditer**
4. Modifiez la valeur
5. Cliquez **Sauvegarder**
6. ✅ Confirmez sur votre site (rafraîchissez)

---

## Gestion des Articles & Blog

### Accés
**Barre latérale** → **Contenu** → **Articles**

### Créer un Nouvel Article

#### Étape 1 : Cliquer sur "➕ Créer"
Bouton en haut à droite de la liste des articles

#### Étape 2 : Remplissez les Champs

| Champ | Type | Obligatoire | Notes |
|-------|------|-------------|-------|
| **Titre** | Texte | ✅ | Sera visible dans l'URL (slug) |
| **Catégorie** | Sélection | ✅ | Choisir parmi les catégories existantes |
| **Image Principale** | Image | ✴️ | Recommandée (taille: 800x600px recommandée) |
| **Description Courte** | Texte court | ✴️ | Pour les aperçus (max 160 caractères SEO) |
| **Contenu** | Éditeur Riche | ✅ | Corps de l'article (texte, images, vidéos) |
| **Date de Publication** | Date | ✅ | Défaut: aujourd'hui |
| **Auteur** | Sélection | ✅ | Vous-même par défaut |
| **Tags/Mots-clés** | Texte | ✴️ | Séparés par des virgules (ex: "événement, communication") |
| **État** | Sélection | ✅ | Brouillon ou Publié |

#### Étape 3 : SEO

Remplissez les champs SEO pour le référencement:
- **Meta Title** : Titre pour Google (55-60 caractères)
- **Meta Description** : Description pour Google (155-160 caractères)
- **Meta Keywords** : Mots-clés (5-8 mots)

#### Étape 4 : Sauvegarder

- **Sauvegarder en Brouillon** : Article non visible publiquement
- **Publier** : Article visible sur le site immédiatement

### Modifier un Article
1. Allez dans **Contenu** → **Articles**
2. Cherchez l'article dans la liste
3. Cliquez sur le **crayon (✏️)**
4. Modifiez les champs
5. Cliquez **Sauvegarder**

### Supprimer un Article
1. Sélectionnez l'article dans la liste
2. Cliquez sur la **poubelle (🗑️)**
3. Confirmez la suppression
⚠️ **Action irréversible**

### Gestion des Catégories

#### Accés
**Contenu** → **Catégories**

#### Créer une Catégorie
1. Cliquez **➕ Créer**
2. Nom de la catégorie (ex: "Événementiel")
3. Le slug s'auto-génère (ex: "evenementiel")
4. Ajoutez une description
5. Ordonnez les catégories (numéro d'ordre)
6. **Actif** : Cochez pour que la catégorie soit visible
7. **Sauvegarder**

#### Catégories Prédéfinies
Les catégories suivantes sont déjà créées:

- 📰 **Actualités Agence** - Nouvelles de CK Agency
- 📢 **Média & Presse** - Articles presse
- 🎪 **Événementiel** - Gestion d'événements
- 💬 **Communication** - Stratégies de communication
- 🌟 **Inspiration & Culture** - Contenu culturel
- 🎨 **Coulisses & Récits** - Histoires d'événements
- 🤝 **Partenaires** - Mise en avant partenaires
- 📚 **Ressources & Conseils** - Guides pratiques

---

## Gestion du Portfolio (Événements)

### Accés
**Barre latérale** → **Événements** → **Événements**

### Créer un Événement Portfolio

#### Étape 1 : Cliquer sur "➕ Créer"

#### Étape 2 : Informations Principales

| Champ | Description |
|-------|-------------|
| **Titre** | Nom de l'événement (ex: "Mariage Dupont - Février 2026") |
| **Type d'Événement** | Choisir le type: Mariage, Gala, Corporatif, etc. |
| **Date** | Date de l'événement |
| **Lieu** | Localisation (ex: "Grand Hotel, Yaoundé") |
| **Client** | Optionnel - Nom du client |
| **Description** | Détails sur l'événement |

#### Étape 3 : Galerie Média

1. Cliquez sur **"Ajouter des images"**
2. Téléchargez les photos de l'événement
3. Vous pouvez réorganiser les images (drag & drop)
4. Ajoutez une description pour chaque image (optionnel)

**💡 Conseil** : Utilisez des images de haute qualité (min 1200px de largeur)

#### Étape 4 : Détails Supplémentaires

- **Équipe** : Personnes impliquées dans l'événement
- **Tags** : Mots-clés (ex: "prestigious, corporate")
- **Témoignage Client** : Avis client sur l'événement (optionnel)

#### Étape 5 : Publication

- **État** : Brouillon ou Publié
- **Visible** : La galerie est-elle visible publiquement?
- **Sauvegarder**

### Types d'Événements Disponibles

Les types suivants sont prédéfinis avec des couleurs et icônes:

| Type | Couleur | Icône |
|------|--------|-------|
| 💒 Mariage | #E91E63 (Rose) | heart |
| ✨ Gala & Soirées VIP | #C9A961 (Or) | diamond |
| 👔 Événement Corporatif | #2C3E50 (Bleu foncé) | briefcase |
| 👑 Cérémonie Officielle | #D4AF37 (Or) | crown |
| 🚀 Lancement de Produit | #FF6B6B (Rouge) | rocket |
| 🎤 Conférence & Séminaire | #4ECDC4 (Turquoise) | mic |
| 🎂 Anniversaire & Célébration | #FFD93D (Jaune) | cake |
| 👥 Événement Communautaire | #6BCB77 (Vert) | users |
| ⭐ Festival & Grand Public | #FF006E (Rose vif) | star |
| ✏️ Formation & Atelier | #8366C4 (Violet) | pencil |

---

## Gestion des Utilisateurs

### Accés
**Configuration** → **Utilisateurs**

### Vue des Utilisateurs

Affiche la liste de tous les utilisateurs du site avec:
- Nom & Email
- Rôle (super_admin, admin, user)
- Statut (Actif/Inactif)
- Dernière connexion

### Créer un Nouvel Utilisateur

#### ⚠️ Recommandation :
Pour une petite agence, **un seul compte administrateur** suffit. Créer d'autres comptes seulement si nécessaire.

1. Cliquez **➕ Créer**
2. Remplissez:
   - **Nom** : Nom complet
   - **Email** : Email unique
   - **Mot de passe** : Mot de passe sécurisé (min 8 caractères)
   - **Rôle** : super_admin, admin, editor, user
   - **Actif** : Cochez pour que le compte soit utilisable
3. **Sauvegarder**

### Rôles et Permissions

| Rôle | Permissions |
|------|------------|
| **super_admin** | Accès complet à l'interface admin |
| **admin** | Gestion articles, événements, messages |
| **editor** | Peut créer/modifier articles et événements |
| **user** | Consulter uniquement |

### Modifier un Utilisateur

1. Cherchez l'utilisateur dans la liste
2. Cliquez sur le **crayon (✏️)**
3. Modifiez les champs
4. **Sauvegarder**

### Désactiver un Utilisateur

1. Sélectionnez l'utilisateur
2. Décochez **"Actif"**
3. **Sauvegarder**

⚠️ L'utilisateur ne pourra plus se connecter

---

## Gestion des Messages & Demandes

### Accés
**Communication** → **Messages**

### Vue des Messages

Affiche tous les messages de contact reçus avec:
- **Expéditeur** : Nom & email
- **Sujet** : Objet du message
- **Date** : Quand le message a été reçu
- **Statut** : Lu/Non lu

### Consulter un Message

1. Cliquez sur le message dans la liste
2. Lisez le contenu complet
3. Voyez les coordonnées du client

### Répondre à un Message

1. Ouvrez le message
2. Cliquez **"Répondre"** (bouton en bas)
3. Écrivez votre réponse
4. **Envoyer**

💡 **Conseil** : Répondez aux messages dans les 24h pour une meilleure image

### Marquer comme Traité

1. Ouvrez le message
2. Cliquez **"Marquer comme Traité"** ou **"Archiver"**
3. Le message sera classé

### Gérer les Demandes de Devis

#### Accés
**Communication** → **Demandes de Devis**

Les demandes de devis incluent:
- Type d'événement prévu
- Date & lieu
- Budget indicatif
- Services demandés
- Coordonnées du client

**À faire** :
1. Examinez la demande
2. Contactez le client
3. Envoyez une proposition de devis
4. Marquez comme traité une fois conclu

---

## Gestion des Partenaires

### Accés
**Entreprise** → **Partenaires**

### Créer un Partenaire

1. Cliquez **➕ Créer**
2. Remplissez:
   - **Nom** : Nom du partenaire/entreprise
   - **Logo** : Image du logo (500x500px recommandé)
   - **Description** : Courte description
   - **Secteur/Catégorie** : Domaine d'activité
   - **Contact** : Email / Téléphone
   - **Site Web** : URL du site (optionnel)
   - **Lien vers partenaire** : Vers la page du partenaire
3. **Sauvegarder**

### Affichage

Les partenaires s'affichent sur la page "Nos Partenaires" du site.

---

## Gestion de la Newsletter

### Accés
**Communication** → **Newsletter**

### Vue des Abonnés

Liste de tous les abonnés à la newsletter avec:
- Email
- Date d'inscription
- Statut (Actif/Désabonné)

### Exporter les Abonnés

1. Cliquez **"Exporter"** (bouton en haut à droite)
2. Choisissez le format (CSV / Excel)
3. Fichier téléchargé sur votre ordinateur

💡 **Utilité** : Pour envoyer des newsletters via Mailchimp ou autre service

### Gérer les Abonnés Manuellement

1. Cliquez sur un abonné
2. Modifiez le statut
3. **Sauvegarder**

---

## Configuration SEO

### Accés
**Configuration** → **Paramètres**

### Champs SEO Importants

#### 1. Meta Title (Titre HTML)
- **Longueur** : 50-60 caractères
- **Où** : Onglet du navigateur et résultat Google
- **Exemple** : "CK Agency - Communication & Événementiel à Dschang"

#### 2. Meta Description
- **Longueur** : 150-160 caractères
- **Où** : Aperçu dans les résultats Google
- **Exemple** : "CK Agency propose des services d'événementiel, communication et presse. Présentation professionnelle et organisation d'événements prestigieux."

#### 3. Meta Keywords
- **Recommandé** : 5-10 mots-clés
- **Exemple** : "communication, événementiel, agence, Dschang, mariage, gala, presse"

### Bonnes Pratiques SEO

1. **URL personnalisées** - Slug court et descriptif
2. **Images optimisées** - Compressées avec alt text
3. **Contenu unique** - Évitez la duplication
4. **Mots-clés naturels** - Intégrez-les naturellement
5. **Liens internes** - Liez vos articles entre eux
6. **Mobile-friendly** - Vérifiez l'affichage sur mobile

### Vérifier le SEO

Utilisez **Google Search Console** :
1. Allez sur https://search.google.com/search-console
2. Connectez-vous avec votre compte Google
3. Ajoutez votre site
4. Vérifiez les erreurs de crawl
5. Soumettez votre sitemap

---

## Tips & Bonnes Pratiques

### 📅 Calendrier de Publication Régulière

**Pour un bon référencement** :
- Publiez un article par semaine minimum
- Vérifiez la qualité du contenu
- Réutilisez vos contenus sur réseaux sociaux

### 📸 Conseils Images

1. **Résolution minimale** : 1200px x 800px
2. **Format** : JPG pour photos, PNG pour logos
3. **Taille fichier** : < 500KB (compressez si nécessaire)
4. **Alt text** : Décrivez l'image pour l'accessibilité
5. **Outils gratuits** :
   - Compresser: TinyPNG.com
   - Éditer: Canva.com

### 🔒 Sécurité

- **Changez les mots de passe** régulièrement
- **Sauvegardez vos données** : Demandez une sauvegarde hebdomadaire
- **Vigilance phishing** : N'ouvrez pas les mails suspects
- **Sessions actives** : Déconnectez-vous après chaque session

### 📞 Support et Aide

**Vous avez un problème ?**

1. Consultez ce guide (cherchez votre question)
2. Vérifiez les logs (Configuration → Logs)
3. Contactez votre hébergeur Hostinger
4. Email d'aide : support@ckagency.com

### 💾 Sauvegarde Régulière

**Sauvegarde mensuelle recommandée** :
1. **Panneau Hostinger** → Gestion des fichiers
2. Téléchargez le dossier `/public_html`
3. Export de la base de données via phpMyAdmin
4. Stockez en lieu sûr (Google Drive, OneDrive, etc.)

---

## Cas d'Utilisation Courants

### ❓ "Comment publier un nouvel événement?"

1. Allez dans **Événements** → **Événements**
2. Cliquez **➕ Créer**
3. Remplissez Titre, Type, Date, Lieu
4. Ajoutez les photos de la galerie
5. Cliquez **Publier**

### ❓ "Comment mettre à jour les coordonnées?"

1. Allez dans **Configuration** → **Paramètres**
2. Cherchez "contact_phone", "contact_email"
3. Modifiez les valeurs
4. **Sauvegarder**

### ❓ "Comment créer un article?"

1. Allez dans **Contenu** → **Articles**
2. Cliquez **➕ Créer**
3. Remplissez Titre, Catégorie, Contenu
4. Ajoutez une image principale
5. Remplissez les metas SEO
6. **Publier**

### ❓ "Comment répondre aux messages?"

1. Allez dans **Communication** → **Messages**
2. Ouvrez le message
3. Cliquez **"Répondre"**
4. Écrivez votre réponse
5. **Envoyer**

### ❓ "Comment exporter les abonnés newsletter?"

1. Allez dans **Communication** → **Newsletter**
2. Cliquez le bouton **"Exporter"**
3. Choisissez CSV ou Excel
4. Fichier est prêt

---

## Raccourcis Clavier

| Raccourci | Action |
|-----------|--------|
| `Ctrl+S` ou `Cmd+S` | Sauvegarder |
| `Ctrl+K` ou `Cmd+K` | Recherche globale |
| `Ctrl+D` | Supprimer |
| `Escape` | Fermer modal |

---

## 🎓 Formation & Support

### Ressources Utiles

- **Documentation Filament** : https://filamentadmin.com
- **Tutoriels Laravel** : https://laravelforever.com
- **Optimisation SEO** : https://moz.com/beginners-guide-to-seo

### Support Direct

**Cynthia Kenne - Directrice**
- Email: cynthiankwete@gmail.com
- Tél: +237 654 81 12 69

---

## 📝 Notes de Version

### v1.0 - Février 2026
- ✅ Interface admin complète
- ✅ Gestion articles & blog
- ✅ Gestion portfolio (événements)
- ✅ Gestion des messages
- ✅ Newsletter
- ✅ Configuration SEO
- ✅ Dashboard statistiques

---

**Dernière mise à jour** : 21 Février 2026  
**Auteur** : CK Agency  
**Licence** : Propriétaire confidentiel

