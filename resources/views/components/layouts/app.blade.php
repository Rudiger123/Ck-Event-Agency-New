<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO STANDARD -->
    <title>{{ $title ?? 'CK Event Agency | Communication & Événementiel' }}</title>
    <meta name="description"
        content="{{ $description ?? 'Agence de communication de presse et événementielle incarnée par Cynthia Kenne. Valorisation de votre image et organisation de vos événements.' }}">
        <link rel="icon" type="image/jpg" href="{{ asset('images/favicon.jpg') }}">

    <!-- OPEN GRAPH (Pour Facebook, WhatsApp, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'CK Event Agency' }}">
    <meta property="og:description"
        content="{{ $description ?? 'Agence de communication de presse et événementielle.' }}">
    <meta property="og:image" content="{{ $image ?? asset('images/logo.png') }}">
    <!-- Image par défaut si aucune fournie -->

    <!-- TWITTER CARD -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'CK Event Agency' }}">
    <meta name="twitter:description"
        content="{{ $description ?? 'Agence de communication de presse et événementielle.' }}">
    <meta name="twitter:image" content="{{ $image ?? asset('images/default-share.jpg') }}">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">

    <!-- STYLES -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-brand-white text-gray-800 font-sans antialiased">

    <!-- HEADER / NAVIGATION -->
    <header x-data="{ mobileMenuOpen: false }"
        class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all duration-300">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->
            <a href="/" class="text-2xl font-serif font-bold tracking-widest text-brand-black">
                CK <span class="text-brand-gold">AGENCY</span>
            </a>

            <!-- MENU DESKTOP -->
            <div class="hidden md:flex space-x-6 items-center">

                <a href="{{ route('home') }}"
                    class="text-xs font-bold uppercase tracking-widest transition duration-300 {{ request()->routeIs('home') ? 'text-brand-gold border-b border-brand-gold pb-1' : 'hover:text-brand-gold' }}">
                    Accueil
                </a>

                <a href="{{ route('about') }}"
                    class="text-xs font-bold uppercase tracking-widest transition duration-300 {{ request()->routeIs('about') ? 'text-brand-gold border-b border-brand-gold pb-1' : 'hover:text-brand-gold' }}">
                    Cyn
                </a>

                <a href="{{ route('services') }}"
                    class="text-xs font-bold uppercase tracking-widest transition duration-300 {{ request()->routeIs('services') ? 'text-brand-gold border-b border-brand-gold pb-1' : 'hover:text-brand-gold' }}">
                    Services
                </a>

                <a href="{{ route('portfolio.index') }}"
                    class="text-xs font-bold uppercase tracking-widest transition duration-300 {{ request()->routeIs('portfolio.*') ? 'text-brand-gold border-b border-brand-gold pb-1' : 'hover:text-brand-gold' }}">
                    Portfolio
                </a>

                <a href="{{ route('blog.index') }}"
                    class="text-xs font-bold uppercase tracking-widest transition duration-300 {{ request()->routeIs('blog.*') ? 'text-brand-gold border-b border-brand-gold pb-1' : 'hover:text-brand-gold' }}">
                    Actualités
                </a>

                <a href="{{ route('contact') }}"
                    class="text-xs font-bold uppercase tracking-widest transition duration-300 {{ request()->routeIs('contact') ? 'text-brand-gold border-b border-brand-gold pb-1' : 'hover:text-brand-gold' }}">
                    Contact
                </a>

                <!-- SÉPARATEUR -->
                <div class="h-4 w-px bg-gray-300 mx-2"></div>

                <!-- SWITCH LANGUE -->
               <!--
                <div class="flex items-center space-x-2 text-xs font-bold mr-2">
                    <a href="{{ route('switch-language', 'fr') }}"
                        class="{{ app()->getLocale() == 'fr' ? 'text-brand-gold' : 'text-gray-400 hover:text-brand-black' }}">FR</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('switch-language', 'en') }}"
                        class="{{ app()->getLocale() == 'en' ? 'text-brand-gold' : 'text-gray-400 hover:text-brand-black' }}">EN</a>
                </div>
               -->
                <!-- BOUTON DEVIS -->
                <a href="{{ route('quote') }}"
                    class="px-5 py-2 bg-brand-gold text-white text-xs font-bold uppercase tracking-widest hover:bg-brand-black transition duration-300 shadow-md transform hover:-translate-y-0.5">
                    Demander un Devis
                </a>
            </div>

            <!-- HAMBURGER MOBILE -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-brand-black focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </nav>

        <!-- MENU MOBILE (AlpineJS) -->
        <div x-show="mobileMenuOpen" style="display: none;" x-transition
            class="md:hidden bg-white border-t border-gray-100 absolute w-full left-0 shadow-lg h-screen">
            <div class="flex flex-col p-8 space-y-6 text-center">
                <a href="{{ route('home') }}" class="text-brand-black font-serif text-xl">Accueil</a>
                <a href="{{ route('about') }}" class="text-brand-black font-serif text-xl">Cynthia</a>
                <a href="{{ route('services') }}" class="text-brand-black font-serif text-xl">Services</a>
                <a href="{{ route('portfolio.index') }}" class="text-brand-black font-serif text-xl">Portfolio</a>
                <a href="{{ route('blog.index') }}" class="text-brand-black font-serif text-xl">Actualités</a>
                <a href="{{ route('contact') }}" class="text-brand-black font-serif text-xl">Contact</a>

                <hr class="border-gray-100">

                <a href="{{ route('quote') }}"
                    class="inline-block px-6 py-3 bg-brand-gold text-white font-bold uppercase tracking-widest">
                    Demander un Devis
                </a>

                <div class="flex justify-center gap-4 pt-4">
                    <a href="{{ route('switch-language', 'fr') }}"
                        class="font-bold {{ app()->getLocale() == 'fr' ? 'text-brand-gold' : 'text-gray-400' }}">FR</a>
                    <a href="{{ route('switch-language', 'en') }}"
                        class="font-bold {{ app()->getLocale() == 'en' ? 'text-brand-gold' : 'text-gray-400' }}">EN</a>
                </div>
            </div>
        </div>
    </header>

    <!-- CONTENU PRINCIPAL -->
    <main class="pt-20 min-h-screen">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="bg-brand-black text-white py-12 border-t-4 border-brand-gold">
        <div class="container mx-auto px-6 grid md:grid-cols-4 gap-8 text-center md:text-left">

            <!-- Colonne 1 : Marque -->
            <div>
                <h3 class="text-2xl font-serif font-bold mb-4">CK <span class="text-brand-gold">AGENCY</span></h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Agence de communication et de presse incarnée par Cynthia Kenne.
                    Valorisation de l'information et élégance événementielle.
                </p>
            </div>

            <!-- Colonne 2 : Liens Rapides -->
            <div>
                <h4 class="text-lg font-serif mb-4 text-brand-gold">Navigation</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/about" class="hover:text-white transition">À Propos de Cyn</a></li>
                    <li><a href="/services" class="hover:text-white transition">Nos Services</a></li>
                    <li><a href="/portfolio" class="hover:text-white transition">Nos Réalisations</a></li>
                    <li><a href="/mentions-legales" class="hover:text-white transition">Mentions Légales</a></li>
                    <li><a href="/politique-confidentialite" class="hover:text-white transition">Politique de
                            Confidentialité</a></li>
                </ul>
            </div>

            <!-- Colonne 3 : Contact Dynamique -->
            <div>
                <h4 class="text-lg font-serif mb-4 text-brand-gold">Contact</h4>

                <!-- Email Dynamique -->
                <p class="text-gray-400 text-sm mb-2">
                    {{ \App\Models\Setting::value('site_email', 'contact@ck-agency.com') }}
                </p>

                <!-- Téléphone Dynamique -->
                <p class="text-gray-400 text-sm mb-4">
                    {{ \App\Models\Setting::value('site_phone', '+237 00 00 00 00') }}
                </p>

                <!-- Réseaux Sociaux Dynamiques -->
                <div class="flex justify-center md:justify-start space-x-4">
                    @if (\App\Models\Setting::value('url_instagram'))
                        <a href="{{ \App\Models\Setting::value('url_instagram') }}" target="_blank"
                            class="text-gray-400 hover:text-brand-gold transition">Instagram</a>
                    @endif

                    @if (\App\Models\Setting::value('url_linkedin'))
                        <a href="{{ \App\Models\Setting::value('url_linkedin') }}" target="_blank"
                            class="text-gray-400 hover:text-brand-gold transition">LinkedIn</a>
                    @endif

                    @if (\App\Models\Setting::value('url_facebook'))
                        <a href="{{ \App\Models\Setting::value('url_facebook') }}" target="_blank"
                            class="text-gray-400 hover:text-brand-gold transition">Facebook</a>
                    @endif
                </div>
            </div>

            <!-- Colonne 3 : Newsletter & Contact -->
            <div>
                <livewire:newsletter-form />
            </div>
        </div>

        <div class="text-center mt-12 border-t border-gray-800 pt-8 text-xs text-gray-500">
            &copy; {{ date('Y') }} CK Event Agency. Fait avec passion.
        </div>
    </footer>
    
    <!-- INDICATEUR ADMIN (Visible seulement si connecté) -->
    @auth
        <div x-data="{ open: false }" 
             class="fixed bottom-6 left-6 z-[100] font-sans">
            
            <!-- Le Badge Principal -->
            <div class="flex items-center gap-2 bg-brand-black text-white px-4 py-3 rounded shadow-2xl border border-gray-700 hover:border-brand-gold transition duration-300">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                
                <div class="flex flex-col">
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 leading-none">Connecté en tant que</span>
                    <span class="text-sm font-bold text-brand-gold leading-none mt-1">{{ Auth::user()->name }}</span>
                </div>

                <!-- Séparateur -->
                <div class="w-px h-6 bg-gray-700 mx-2"></div>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <a href="/admin" class="text-xs font-bold hover:text-brand-gold transition" title="Aller au Tableau de Bord">
                        Dashboard
                    </a>
                    
                    <!-- Bouton Déconnexion (Formulaire caché) -->
                    <form method="POST" action="{{ route('filament.admin.auth.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-400 transition" title="Se déconnecter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</body>

</html>
