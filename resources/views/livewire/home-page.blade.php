<div>
    <!-- 1. HERO SECTION (Déjà existant) -->
    <div class="relative w-full h-[85vh] flex items-center justify-center bg-brand-black overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10"></div>
        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop" 
             class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Background">

        <div class="relative z-20 text-center px-4 max-w-5xl mx-auto" x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)">
            <p class="text-brand-gold tracking-[0.3em] uppercase text-xs md:text-sm mb-6 animate-pulse">
                Agence de Communication & Presse
            </p>
            <h1 x-show="show" x-transition.duration.1000ms class="text-5xl md:text-7xl lg:text-8xl font-serif text-white font-bold mb-8 leading-tight">
                L'Élégance de <br> <span class="text-brand-gold italic">Votre Image</span>
            </h1>
            <p x-show="show" x-transition.delay.500ms class="text-gray-200 text-lg md:text-xl font-light mb-12 max-w-2xl mx-auto">
                Incarnée par Cynthia Kenne, nous transformons vos actualités et événements en moments inoubliables.
            </p>
            
            <div x-show="show" x-transition.delay.800ms class="flex flex-col md:flex-row gap-6 justify-center">
                <a href="{{ route('portfolio.index') }}" class="px-8 py-4 bg-brand-gold text-brand-black font-bold uppercase tracking-widest hover:bg-white transition duration-300">
                    Nos Réalisations
                </a>
                <a href="{{ route('quote') }}" class="px-8 py-4 border border-white text-white font-bold uppercase tracking-widest hover:bg-white hover:text-brand-black transition duration-300">
                    Demander un Devis
                </a>
            </div>
        </div>
    </div>

    <!-- 2. [NOUVEAU] SECTION VISION / À PROPOS (Teaser) -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <!-- Texte -->
                <div class="w-full md:w-1/2">
                    <span class="text-brand-gold uppercase tracking-widest text-xs font-bold">La Signature CK</span>
                    <h2 class="text-4xl font-serif font-bold text-brand-black mt-4 mb-6 leading-tight">
                        Plus qu'une agence, <br>une vision humaine.
                    </h2>
                    <p class="text-gray-600 font-light text-lg leading-relaxed mb-6">
                        CK Event Agency est née d'une volonté : celle de redonner ses lettres de noblesse à la communication de proximité. 
                        Que ce soit par la plume journalistique ou la mise en scène événementielle, nous portons chaque projet avec une exigence d'excellence.
                    </p>
                    <p class="text-gray-600 font-light text-lg leading-relaxed mb-8">
                        Portée par <strong>Cynthia Kenne</strong>, l'agence allie la rigueur de la presse à la créativité de l'événementiel pour sublimer vos messages.
                    </p>
                    <a href="{{ route('about') }}" class="inline-block text-brand-black uppercase tracking-widest text-xs font-bold border-b-2 border-brand-gold pb-1 hover:text-brand-gold transition">
                        Découvrir Cynthia
                    </a>
                </div>
                <!-- Image Déco -->
                <div class="w-full md:w-1/2 relative">
                    <div class="absolute inset-0 border-2 border-brand-gold translate-x-6 translate-y-6 hidden md:block"></div>
                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=1000&auto=format&fit=crop" 
                         alt="Vision Agence" 
                         class="relative z-10 w-full h-[500px] object-cover shadow-2xl grayscale hover:grayscale-0 transition duration-1000">
                </div>
            </div>
        </div>
    </section>

    <!-- 3. [NOUVEAU] SECTION SERVICES (Résumé) -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <span class="text-gray-400 uppercase tracking-widest text-xs font-bold">Nos Expertises</span>
            <h2 class="text-4xl font-serif font-bold text-brand-black mt-4 mb-16">Ce que nous faisons</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white p-10 shadow-sm hover:shadow-xl transition duration-500 transform hover:-translate-y-2">
                    <div class="text-4xl mb-6">🎙️</div>
                    <h3 class="text-xl font-serif font-bold mb-4">Imprésariat & Events</h3>
                    <p class="text-gray-500 font-light text-sm mb-6">
                        Présentation professionnelle de vos cérémonies, mariages et événements officiels avec éloquence et maîtrise.
                    </p>
                    <a href="{{ route('services') }}" class="text-brand-gold text-xs uppercase tracking-widest font-bold">En savoir plus</a>
                </div>

                <!-- Service 2 -->
                <div class="bg-white p-10 shadow-sm hover:shadow-xl transition duration-500 transform hover:-translate-y-2 border-t-4 border-brand-gold">
                    <div class="text-4xl mb-6">📰</div>
                    <h3 class="text-xl font-serif font-bold mb-4">Presse & Médias</h3>
                    <p class="text-gray-500 font-light text-sm mb-6">
                        Couverture médiatique, relations presse et diffusion stratégique de vos messages auprès des journalistes.
                    </p>
                    <a href="{{ route('services') }}" class="text-brand-gold text-xs uppercase tracking-widest font-bold">En savoir plus</a>
                </div>

                <!-- Service 3 -->
                <div class="bg-white p-10 shadow-sm hover:shadow-xl transition duration-500 transform hover:-translate-y-2">
                    <div class="text-4xl mb-6">✍️</div>
                    <h3 class="text-xl font-serif font-bold mb-4">Production de Contenu</h3>
                    <p class="text-gray-500 font-light text-sm mb-6">
                        Rédaction d'articles, reportages vidéo et podcasts pour nourrir votre communication d'actualités fiables.
                    </p>
                    <a href="{{ route('services') }}" class="text-brand-gold text-xs uppercase tracking-widest font-bold">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. PORTFOLIO SECTION (Déjà existant - Modifié pour le design) -->
    <section class="py-24 bg-brand-black text-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <span class="text-brand-gold uppercase tracking-widest text-xs font-bold">Portfolio</span>
                    <h2 class="text-4xl font-serif font-bold mt-2">Derniers Événements</h2>
                </div>
                <a href="{{ route('portfolio.index') }}" class="mt-4 md:mt-0 text-white border-b border-brand-gold pb-1 text-xs uppercase tracking-widest hover:text-brand-gold transition">
                    Voir tout le portfolio
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($events as $event)
                <div class="group relative overflow-hidden h-[400px] cursor-pointer block">
                    <!-- Image -->
                    <img src="{{ $event->getFirstMediaUrl('cover_image') }}" 
                         alt="{{ $event->title }}" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110 opacity-70 group-hover:opacity-100">
                    
                    <!-- Overlay au survol -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90">
                        <div class="absolute bottom-0 left-0 p-8 w-full translate-y-4 group-hover:translate-y-0 transition duration-500">
                            @if($event->eventType)
                            <span class="text-brand-gold uppercase tracking-widest text-xs mb-2 block">
                                {{ $event->eventType->name }}
                            </span>
                            @endif
                            <h3 class="text-2xl font-serif font-bold mb-2">{{ $event->title }}</h3>
                            <a href="{{ route('portfolio.show', $event->slug) }}" class="inline-block text-white border-b border-white pb-1 text-sm opacity-0 group-hover:opacity-100 transition delay-100">
                                Découvrir le projet
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. TÉMOIGNAGES (Slider Interactif) -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Éléments décoratifs d'arrière-plan -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-brand-gold/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-brand-black/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl font-serif font-bold text-brand-black mb-16 text-center">Ils nous font confiance</h2>
            
            @if($testimonials->count() > 0)
                <!-- COMPOSANT SLIDER ALPINE.JS -->
                <div x-data="{ 
                        activeSlide: 0, 
                        slides: {{ $testimonials->count() }},
                        autoplay: null,
                        startAutoplay() {
                            this.autoplay = setInterval(() => {
                                this.next();
                            }, 6000); // Change toutes les 6 secondes
                        },
                        stopAutoplay() {
                            clearInterval(this.autoplay);
                        },
                        next() {
                            this.activeSlide = (this.activeSlide + 1) % this.slides;
                        },
                        prev() {
                            this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides;
                        }
                     }" 
                     x-init="startAutoplay()"
                     @mouseenter="stopAutoplay()"
                     @mouseleave="startAutoplay()"
                     class="relative max-w-4xl mx-auto">

                    <!-- SLIDES -->
                    <div class="relative min-h-[300px] md:min-h-[250px]">
                        @foreach($testimonials as $index => $testimonial)
                            <div x-show="activeSlide === {{ $index }}"
                                 x-transition:enter="transition ease-out duration-700"
                                 x-transition:enter-start="opacity-0 translate-x-10"
                                 x-transition:enter-end="opacity-100 translate-x-0"
                                 x-transition:leave="transition ease-in duration-300 absolute top-0 left-0 w-full"
                                 x-transition:leave-start="opacity-100 translate-x-0"
                                 x-transition:leave-end="opacity-0 -translate-x-10"
                                 class="bg-gray-50 p-8 md:p-12 border border-gray-100 rounded-sm shadow-sm flex flex-col md:flex-row gap-8 items-center text-center md:text-left">
                                
                                <!-- Photo Client -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $testimonial->getFirstMediaUrl('avatar') ?: 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->name) . '&background=C9A961&color=fff' }}" 
                                         alt="{{ $testimonial->name }}" 
                                         class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                                </div>

                                <!-- Contenu -->
                                <div class="flex-grow">
                                    <div class="text-brand-gold text-2xl mb-2">
                                        {{ str_repeat('★', $testimonial->rating) }}
                                    </div>
                                    <div class="text-6xl text-brand-gold opacity-10 font-serif absolute top-4 right-8 font-bold">"</div>
                                    
                                    <p class="text-gray-600 italic font-light text-lg mb-6 relative z-10 leading-relaxed">
                                        {{ $testimonial->content }}
                                    </p>
                                    
                                    <div>
                                        <h4 class="font-bold text-brand-black text-sm uppercase tracking-widest">{{ $testimonial->name }}</h4>
                                        <span class="text-xs text-gray-400">{{ $testimonial->role }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- CONTROLES (Flèches) -->
                    <button @click="prev()" class="absolute top-1/2 -left-4 md:-left-12 -translate-y-1/2 w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-400 hover:text-brand-gold hover:border-brand-gold transition shadow-lg z-20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="next()" class="absolute top-1/2 -right-4 md:-right-12 -translate-y-1/2 w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-400 hover:text-brand-gold hover:border-brand-gold transition shadow-lg z-20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>

                    <!-- DOTS (Indicateurs) -->
                    <div class="flex justify-center gap-3 mt-8">
                        @foreach($testimonials as $index => $testimonial)
                            <button @click="activeSlide = {{ $index }}" 
                                    class="w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? '' : '' }}"
                                    :class="activeSlide === {{ $index }} ? 'bg-brand-gold w-8' : 'bg-gray-300 hover:bg-gray-400'">
                            </button>
                        @endforeach
                    </div>

                </div>
            @else
                <p class="text-center text-gray-400 italic">Aucun témoignage pour le moment.</p>
            @endif
        </div>
    </section>

    <!-- 6. BLOG SECTION (Déjà existant) -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <span class="text-brand-gold uppercase tracking-widest text-xs font-bold">Le Blog</span>
                    <h2 class="text-4xl font-serif font-bold text-brand-black mt-2">À la Une</h2>
                </div>
                <a href="{{ route('blog.index') }}" class="hidden md:inline-block text-brand-black hover:text-brand-gold uppercase tracking-widest text-xs border-b border-brand-black pb-1 hover:border-brand-gold transition">
                    Voir tous les articles
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                @foreach($articles as $article)
                <article class="group cursor-pointer">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-64 mb-6">
                        <img src="{{ $article->getFirstMediaUrl('featured_image') }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        
                        @if($article->category)
                        <span class="absolute top-4 left-4 bg-brand-gold text-white text-xs px-3 py-1 uppercase tracking-wider">
                            {{ $article->category->name }}
                        </span>
                        @endif
                    </div>

                    <!-- Contenu -->
                    <div class="pr-4">
                        <div class="text-gray-400 text-xs uppercase tracking-widest mb-2">
                            {{ $article->published_at?->translatedFormat('d F Y') }}
                        </div>
                        <h3 class="text-xl font-serif font-bold text-brand-black mb-3 group-hover:text-brand-gold transition">
                            <a href="{{ route('blog.show', $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 font-light line-clamp-3">
                            {{ $article->excerpt }}
                        </p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 7. [NOUVEAU] CTA FINAL (Action) -->
    <section class="py-24 bg-brand-black text-center relative overflow-hidden">
        <!-- Fond déco -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">
                Prêt à sublimer votre événement ?
            </h2>
            <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto font-light">
                Discutons de votre projet et construisons ensemble une communication à votre image.
            </p>
            <a href="{{ route('quote') }}" class="inline-block px-10 py-4 bg-brand-gold text-brand-black font-bold uppercase tracking-widest hover:bg-white transition duration-300 transform hover:-translate-y-1 shadow-2xl">
                Obtenir un Devis Gratuit
            </a>
        </div>
    </section>
</div>