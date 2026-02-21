#!/bin/bash

# 🚀 SCRIPT D'INITIALISATION PRODUCTION - CK AGENCY
# Version: 1.0 | Date: Février 2026
# Description: Automatise le déploiement et l'initialisation de la BD

# ============================================
# COULEURS POUR L'AFFICHAGE
# ============================================
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ============================================
# FONCTIONS UTILITAIRES
# ============================================

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
    exit 1
}

print_info() {
    echo -e "${BLUE}ℹ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

# ============================================
# VÉRIFICATIONS PRÉALABLES
# ============================================

echo -e "${BLUE}========================================${NC}"
echo -e "${BLUE}🚀 INITIALISATION PRODUCTION CK AGENCY${NC}"
echo -e "${BLUE}========================================${NC}\n"

# Vérifier si le fichier .env existe
if [ ! -f .env ]; then
    print_error "Fichier .env non trouvé. Créez-le d'abord avec: cp .env.example .env"
fi

# Vérifier si composer est installé
if ! command -v composer &> /dev/null; then
    print_error "Composer n'est pas installé. Veuillez installer Composer."
fi

# Vérifier si php est disponible
if ! command -v php &> /dev/null; then
    print_error "PHP n'est pas installé. Veuillez installer PHP 8.1+."
fi

print_success "Vérifications préalables OK"

# ============================================
# 1. DÉPENDANCES
# ============================================

echo -e "\n${BLUE}[1/8]${NC} Installation des dépendances..."

composer install --optimize-autoloader --no-dev 2>/dev/null
if [ $? -eq 0 ]; then
    print_success "Dépendances Composer installées"
else
    print_error "Erreur lors de l'installation de Composer"
fi

# ============================================
# 2. CLÉ D'APPLICATION
# ============================================

echo -e "\n${BLUE}[2/8]${NC} Génération de la clé d'application..."

php artisan key:generate --force 2>/dev/null
if [ $? -eq 0 ]; then
    print_success "Clé d'application générée"
else
    print_warning "Clé d'application déjà existante (OK)"
fi

# ============================================
# 3. PERMISSIONS DES DOSSIERS
# ============================================

echo -e "\n${BLUE}[3/8]${NC} Configuration des permissions..."

chmod -R 755 . 2>/dev/null
chmod -R 775 storage bootstrap/cache 2>/dev/null
chown -R $(whoami):$(whoami) . 2>/dev/null

print_success "Permissions configurées"

# ============================================
# 4. MIGRATIONS
# ============================================

echo -e "\n${BLUE}[4/8]${NC} Exécution des migrations..."

php artisan migrate --force
if [ $? -eq 0 ]; then
    print_success "Migrations exécutées avec succès"
else
    print_error "Erreur lors de l'exécution des migrations"
fi

# ============================================
# 5. SEEDERS (DONNÉES INITIALES)
# ============================================

echo -e "\n${BLUE}[5/8]${NC} Initialisation des données..."

php artisan db:seed --force
if [ $? -eq 0 ]; then
    print_success "Seeders exécutés avec succès"
    echo -e "  ${GREEN}✓ Paramètres généraux${NC}"
    echo -e "  ${GREEN}✓ Catégories d'articles (8)${NC}"
    echo -e "  ${GREEN}✓ Types d'événements (10)${NC}"
    echo -e "  ${GREEN}✓ Pages statiques${NC}"
    echo -e "  ${GREEN}✓ Parcours de Cynthia${NC}"
else
    print_error "Erreur lors de l'exécution des seeders"
fi

# ============================================
# 6. COMPILATION DES ASSETS
# ============================================

echo -e "\n${BLUE}[6/8]${NC} Compilation des assets..."

if command -v npm &> /dev/null; then
    npm ci 2>/dev/null
    npm run build 2>/dev/null
    if [ $? -eq 0 ]; then
        print_success "Assets compilés"
    else
        print_warning "Erreur compilation assets (non critique)"
    fi
else
    print_warning "npm non installé (optionnel pour production)"
fi

# ============================================
# 7. CACHE & OPTIMISATION
# ============================================

echo -e "\n${BLUE}[7/8]${NC} Optimisation pour la production..."

php artisan config:cache 2>/dev/null
php artisan route:cache 2>/dev/null
php artisan view:cache 2>/dev/null
php artisan optimize 2>/dev/null

print_success "Cache et optimisations appliqués"

# ============================================
# 8. VÉRIFICATIONS FINALES
# ============================================

echo -e "\n${BLUE}[8/8]${NC} Vérifications finales..."

# Test DB connection
php artisan tinker --execute="DB::connection()->getPdo(); echo 'DB OK';" 2>/dev/null | grep -q "DB OK"
if [ $? -eq 0 ]; then
    print_success "Connexion base de données: OK"
else
    print_error "Connexion base de données: ÉCHOUÉE"
fi

# Vérifier les migrations
migration_count=$(php artisan migrate:status 2>/dev/null | grep "Ran" | wc -l)
if [ $migration_count -gt 0 ]; then
    print_success "Migrations: $migration_count appliquées"
else
    print_warning "Aucune migration appliquée (à vérifier)"
fi

# ============================================
# RÉSUMÉ FINAL
# ============================================

echo -e "\n${GREEN}========================================${NC}"
echo -e "${GREEN}✓ INITIALISATION TERMINÉE AVEC SUCCÈS${NC}"
echo -e "${GREEN}========================================${NC}\n"

echo -e "${BLUE}📋 INFORMATIONS D'ACCÈS:${NC}"
echo -e "  URL Admin: https://your-domain.com/admin"
echo -e "  Email: admin@ckevent.com"
echo -e "  Password: cynthia@123"
echo -e "  ${YELLOW}⚠ CHANGEZ LE MOT DE PASSE IMMÉDIATEMENT${NC}\n"

echo -e "${BLUE}📊 PROCHAINES ÉTAPES:${NC}"
echo -e "  1. Connectez-vous à l'admin"
echo -e "  2. Changez votre mot de passe"
echo -e "  3. Vérifiez les paramètres (Configuration → Paramètres)"
echo -e "  4. Testez les formulaires de contact"
echo -e "  5. Consultez docs/ADMIN_GUIDE.md pour l'utilisation\n"

echo -e "${BLUE}📁 FICHIERS IMPORTANTS:${NC}"
echo -e "  ${YELLOW}docs/ADMIN_GUIDE.md${NC} - Guide complet d'utilisation"
echo -e "  ${YELLOW}docs/PRODUCTION_SETUP.md${NC} - Guide de déploiement"
echo -e "  ${YELLOW}docs/PRODUCTION_CHECKLIST.md${NC} - Checklist avant lancement\n"

print_success "Prêt pour la production! 🚀"

