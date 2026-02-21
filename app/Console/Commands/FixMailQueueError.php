<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FixMailQueueError extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:fix-queue-error
                            {--force : Force clearing all caches without confirmation}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Résoudre l\'erreur "No hint path defined for [mail]" en nettoyant les caches et en vérifiant la configuration';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Résolution de l\'erreur Mail Queue...');
        $this->newLine();

        // 1. Vérifier la configuration
        $this->info('✓ Étape 1: Vérification de config/mail.php');
        $this->checkMailConfig();
        $this->newLine();

        // 2. Vérifier les composants mail
        $this->info('✓ Étape 2: Vérification des composants mail');
        $this->checkMailComponents();
        $this->newLine();

        // 3. Nettoyer les caches
        if ($this->option('force') || $this->confirm('Voulez-vous nettoyer les caches?')) {
            $this->info('✓ Étape 3: Nettoyage des caches');
            $this->clearCaches();
            $this->newLine();
        }

        // 4. Régénérer les caches
        if ($this->option('force') || $this->confirm('Voulez-vous régénérer les caches (config:cache)?')) {
            $this->info('✓ Étape 4: Régénération des caches');
            $this->regenerateCaches();
            $this->newLine();
        }

        // 5. Vérifier la queue
        $this->info('✓ Étape 5: Vérification de la file d\'attente');
        $this->checkQueue();
        $this->newLine();

        $this->info('✅ Résolution terminée!');
        $this->line('');
        $this->warn('⚠️  IMPORTANT sur Hostinger:');
        $this->warn('Vous DEVEZ redémarrer le queue:work pour appliquer les changements.');
        $this->warn('');
        $this->warn('Commande cron à ajouter dans cPanel:');
        $this->warn('* * * * * cd /path/public_html && php artisan queue:work --max-jobs=1000 --max-time=3600 >> /dev/null 2>&1');
        $this->line('');

        return Command::SUCCESS;
    }

    /**
     * Vérifier la configuration mail
     */
    private function checkMailConfig(): void
    {
        $mailConfig = config('mail');

        if (!isset($mailConfig['markdown'])) {
            $this->error('❌ La section "markdown" est manquante dans config/mail.php');
            $this->line('   Veuillez ajouter:');
            $this->line('   "markdown" => [');
            $this->line('       "theme" => "default",');
            $this->line('       "paths" => [resource_path("views/vendor/mail")],');
            $this->line('   ],');
            return;
        }

        $this->info('✅ La section "markdown" est bien configurée');
        $this->line('   Theme: ' . ($mailConfig['markdown']['theme'] ?? 'default'));
        $this->line('   Paths: ' . implode(', ', $mailConfig['markdown']['paths'] ?? []));
    }

    /**
     * Vérifier les composants mail
     */
    private function checkMailComponents(): void
    {
        $vendorMailPath = resource_path('views/vendor/mail');

        if (!File::exists($vendorMailPath)) {
            $this->error('❌ Le dossier vendor/mail n\'existe pas');
            $this->line('   Exécutez: php artisan vendor:publish --tag=laravel-mail');
            return;
        }

        $this->info('✅ Le dossier vendor/mail existe');

        // Vérifier les sous-dossiers
        $htmlPath = "{$vendorMailPath}/html";
        $textPath = "{$vendorMailPath}/text";

        if (File::exists($htmlPath)) {
            $htmlComponents = count(File::files($htmlPath));
            $this->line("   ✓ HTML components: {$htmlComponents} fichiers");
        }

        if (File::exists($textPath)) {
            $textComponents = count(File::files($textPath));
            $this->line("   ✓ Text components: {$textComponents} fichiers");
        }
    }

    /**
     * Nettoyer tous les caches
     */
    private function clearCaches(): void
    {
        $this->call('config:clear');
        $this->line('');

        $this->call('cache:clear');
        $this->line('');

        $this->call('view:clear');
        $this->line('');

        $this->call('route:clear');
        $this->line('');

        $this->info('✅ Tous les caches ont été nettoyés');
    }

    /**
     * Régénérer les caches
     */
    private function regenerateCaches(): void
    {
        $this->call('config:cache');
        $this->line('');

        $this->info('✅ Cache de configuration régénéré');

        // Optionnel: Route cache si pas en debug
        if (!config('app.debug')) {
            $this->call('route:cache');
            $this->line('');
            $this->info('✅ Cache des routes régénéré');
        }
    }

    /**
     * Vérifier la queue
     */
    private function checkQueue(): void
    {
        try {
            // Vérifier les failed jobs
            $failedCount = DB::table('failed_jobs')->count();

            if ($failedCount > 0) {
                $this->warn("⚠️  {$failedCount} job(s) échoué(s) trouvé(s)");
                $this->line('   Exécutez: php artisan queue:retry all');
            } else {
                $this->info('✅ Aucun job échoué');
            }

            // Vérifier les jobs en attente
            $pendingCount = DB::table('jobs')->count();
            if ($pendingCount > 0) {
                $this->info("ℹ️  {$pendingCount} job(s) en attente");
            }
        } catch (\Exception $e) {
            $this->warn('⚠️  Impossible d\'accéder à la base de données des jobs');
            $this->line('   Vérifiez que la queue connection est "database"');
        }
    }
}
