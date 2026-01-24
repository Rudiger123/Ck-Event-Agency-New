<x-filament::section class="border-l-4 border-l-amber-500">
    <div class="flex items-center gap-6">
        <!-- Icône -->
        <div class="hidden md:flex h-16 w-16 items-center justify-center rounded-full bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-500">
            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
        </div>

        <!-- Texte -->
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-950 dark:text-white">
                Ravi de vous revoir, {{ $user->name }} 👋
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Voici ce qui se passe sur <strong>CK Event Agency</strong> aujourd'hui.
            </p>
        </div>

        <!-- Boutons d'action -->
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="/" target="_blank" 
               class="inline-flex items-center justify-center rounded-lg bg-gray-950 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-gray-800 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 transition">
                <span>Voir le site</span>
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
            
            <a href="/admin/quote-requests" 
               class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-950 shadow-sm hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 transition">
                Gérer les devis
            </a>
        </div>
    </div>
</x-filament::section>