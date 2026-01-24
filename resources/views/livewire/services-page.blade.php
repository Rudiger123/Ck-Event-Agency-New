<div class="bg-white min-h-screen">
    
    <!-- HEADER -->
    <div class="relative py-32 bg-brand-black text-white text-center overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="relative z-10 container mx-auto px-6">
            <span class="text-brand-gold uppercase tracking-[0.3em] text-xs font-bold animate-pulse">Savoir-Faire</span>
            <h1 class="text-5xl md:text-7xl font-serif font-bold mt-4">Notre Expertise</h1>
        </div>
    </div>

    @if($page)
        <!-- INTRO -->
        <div class="container mx-auto px-6 py-20 text-center max-w-4xl">
            <div class="prose prose-lg mx-auto text-gray-600 font-light leading-relaxed">
                {!! $page->content !!}
            </div>
        </div>
    @endif

    <!-- 3 SERVICES DÉTAILLÉS (Design Amélioré) -->
    <div class="bg-gray-50 py-24">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Service 1 -->
                <div class="bg-white p-10 shadow-sm hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 border-t-4 border-brand-black hover:border-brand-gold group">
                    <div class="text-5xl mb-6 text-gray-300 group-hover:text-brand-gold transition">🎙️</div>
                    <h3 class="text-2xl font-serif font-bold text-brand-black mb-4">Imprésariat & Events</h3>
                    <p class="text-gray-500 font-light mb-6">
                        L'art de la parole et de la présence scénique. Nous orchestrons vos cérémonies avec une élégance protocolaire irréprochable.
                    </p>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Maître de Cérémonie</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Coordination Jour J</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Discours officiels</li>
                    </ul>
                </div>

                <!-- Service 2 -->
                <div class="bg-white p-10 shadow-sm hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 border-t-4 border-brand-black hover:border-brand-gold group">
                    <div class="text-5xl mb-6 text-gray-300 group-hover:text-brand-gold transition">📰</div>
                    <h3 class="text-2xl font-serif font-bold text-brand-black mb-4">Relations Presse</h3>
                    <p class="text-gray-500 font-light mb-6">
                        Faites résonner votre message. Nous construisons des ponts solides entre votre marque et les médias influents.
                    </p>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Communiqués de presse</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Conférences de presse</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Veille médiatique</li>
                    </ul>
                </div>

                <!-- Service 3 -->
                <div class="bg-white p-10 shadow-sm hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 border-t-4 border-brand-black hover:border-brand-gold group">
                    <div class="text-5xl mb-6 text-gray-300 group-hover:text-brand-gold transition">✍️</div>
                    <h3 class="text-2xl font-serif font-bold text-brand-black mb-4">Brand Content</h3>
                    <p class="text-gray-500 font-light mb-6">
                        Des contenus qui captivent. Articles, interviews ou reportages vidéo, nous racontons votre histoire avec justesse.
                    </p>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Rédaction web & print</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Reportages vidéo</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span> Podcasts</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- NOUVELLE SECTION : LE PROCESSUS (AJOUTE DU CORPS À LA PAGE) -->
    <div class="py-24 bg-brand-black text-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-brand-gold uppercase tracking-widest text-xs font-bold">Méthodologie</span>
                <h2 class="text-4xl font-serif font-bold mt-2">Comment nous travaillons</h2>
            </div>

            <div class="grid md:grid-cols-4 gap-8 text-center relative">
                <!-- Ligne connectrice (Hidden on mobile) -->
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-800 z-0"></div>

                <!-- Étape 1 -->
                <div class="relative z-10 group">
                    <div class="w-24 h-24 mx-auto bg-brand-black border-2 border-brand-gold rounded-full flex items-center justify-center text-2xl font-serif font-bold mb-6 group-hover:bg-brand-gold group-hover:text-black transition duration-500">01</div>
                    <h3 class="text-xl font-bold mb-2">Écoute</h3>
                    <p class="text-gray-400 text-sm font-light">Compréhension de vos besoins et de votre ADN.</p>
                </div>

                <!-- Étape 2 -->
                <div class="relative z-10 group">
                    <div class="w-24 h-24 mx-auto bg-brand-black border-2 border-gray-700 group-hover:border-brand-gold rounded-full flex items-center justify-center text-2xl font-serif font-bold mb-6 group-hover:bg-brand-gold group-hover:text-black transition duration-500">02</div>
                    <h3 class="text-xl font-bold mb-2">Stratégie</h3>
                    <p class="text-gray-400 text-sm font-light">Élaboration d'un plan de communication sur mesure.</p>
                </div>

                <!-- Étape 3 -->
                <div class="relative z-10 group">
                    <div class="w-24 h-24 mx-auto bg-brand-black border-2 border-gray-700 group-hover:border-brand-gold rounded-full flex items-center justify-center text-2xl font-serif font-bold mb-6 group-hover:bg-brand-gold group-hover:text-black transition duration-500">03</div>
                    <h3 class="text-xl font-bold mb-2">Action</h3>
                    <p class="text-gray-400 text-sm font-light">Déploiement opérationnel et production.</p>
                </div>

                <!-- Étape 4 -->
                <div class="relative z-10 group">
                    <div class="w-24 h-24 mx-auto bg-brand-black border-2 border-gray-700 group-hover:border-brand-gold rounded-full flex items-center justify-center text-2xl font-serif font-bold mb-6 group-hover:bg-brand-gold group-hover:text-black transition duration-500">04</div>
                    <h3 class="text-xl font-bold mb-2">Bilan</h3>
                    <p class="text-gray-400 text-sm font-light">Analyse des retombées et optimisation.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="py-20 text-center bg-white">
        <h2 class="text-3xl font-serif font-bold text-brand-black mb-6">Un projet en tête ?</h2>
        <a href="{{ route('quote') }}" class="inline-block px-10 py-4 bg-brand-gold text-white font-bold uppercase tracking-widest hover:bg-brand-black transition duration-300 shadow-xl">
            Demander un devis personnalisé
        </a>
    </div>
</div>