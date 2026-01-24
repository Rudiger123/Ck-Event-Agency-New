<div class="bg-white min-h-screen">
    @if($page)
        <!-- SECTION HERO SIMPLE -->
        <div class="bg-brand-black text-white py-20 text-center">
            <h1 class="text-4xl md:text-5xl font-serif font-bold">{{ $page->title }}</h1>
            <div class="w-20 h-1 bg-brand-gold mx-auto mt-6"></div>
        </div>

        <div class="container mx-auto px-6 py-20">
            <div class="flex flex-col md:flex-row items-center gap-16">
                
                <!-- PHOTO (Cadre élégant) -->
                <div class="w-full md:w-1/2 relative">
                    <div class="absolute inset-0 border-2 border-brand-gold translate-x-4 translate-y-4 hidden md:block"></div>
                    <!-- Image chargée depuis l'admin ou placeholder -->
                    <img src="{{ $page->getFirstMediaUrl('hero_image') ?: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1000&auto=format&fit=crop' }}" 
                         alt="Cynthia Kenne" 
                         class="relative z-10 w-full h-auto object-cover shadow-xl grayscale hover:grayscale-0 transition duration-1000">
                </div>

                <!-- TEXTE -->
                <div class="w-full md:w-1/2">
                    <h2 class="text-brand-gold text-sm uppercase tracking-widest font-bold mb-4">La Fondatrice</h2>
                    <div class="prose prose-lg text-gray-600 font-light prose-headings:font-serif prose-headings:text-brand-black">
                        {!! $page->content !!}
                    </div>

                    <!-- SIGNATURE -->
                    <div class="mt-12">
                        <p class="font-serif text-2xl italic text-brand-black">Cynthia Kenne</p>
                        <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Directrice Générale</p>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('contact') }}" class="inline-block px-8 py-3 bg-brand-black text-white text-xs uppercase tracking-widest hover:bg-brand-gold transition">
                            Travailler avec moi
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- PARCOURS (TIMELINE) -->
        <div class="bg-white py-20 overflow-hidden">
            <div class="container mx-auto px-6 max-w-4xl">
                <div class="text-center mb-16">
                    <span class="text-brand-gold uppercase tracking-widest text-xs font-bold">Son Histoire</span>
                    <h2 class="text-3xl font-serif font-bold text-brand-black mt-2">Le Parcours de Cynthia</h2>
                </div>

                <div class="relative">
                    <!-- Ligne verticale centrale -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-gray-200"></div>

                    @foreach($journeys as $index => $step)
                    <!-- ITEM TIMELINE -->
                    <div class="relative flex items-center justify-between mb-12 group">
                        
                        <!-- Année (Gauche ou Droite selon index) -->
                        <div class="w-5/12 text-right {{ $index % 2 == 0 ? 'order-1 pr-8' : 'order-3 pl-8 text-left' }}">
                            <span class="text-5xl font-serif font-bold text-gray-100 group-hover:text-brand-gold transition duration-500">
                                {{ $step->year }}
                            </span>
                        </div>

                        <!-- Point Central -->
                        <div class="order-2 w-8 h-8 rounded-full bg-white border-4 border-gray-200 group-hover:border-brand-gold group-hover:scale-125 transition duration-500 z-10 flex items-center justify-center">
                            <!-- Petit point intérieur -->
                            <div class="w-2 h-2 bg-brand-black rounded-full"></div>
                        </div>

                        <!-- Contenu (Droite ou Gauche selon index) -->
                        <div class="w-5/12 {{ $index % 2 == 0 ? 'order-3 pl-8' : 'order-1 pr-8 text-right' }}">
                            <h3 class="font-bold text-lg text-brand-black">{{ $step->title }}</h3>
                            <p class="text-gray-500 text-sm mt-2 font-light">
                                {{ $step->description }}
                            </p>
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>
        </div>

        <!-- VALEURS -->
        <div class="bg-gray-50 py-20">
            <div class="container mx-auto px-6 text-center">
                <h3 class="text-3xl font-serif mb-12">Nos Valeurs</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="p-6">
                        <div class="text-brand-gold text-4xl mb-4">✨</div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-2">Élégance</h4>
                        <p class="text-gray-500 font-light text-sm">Le souci du détail et la recherche du beau dans chaque projet.</p>
                    </div>
                    <div class="p-6">
                        <div class="text-brand-gold text-4xl mb-4">🤝</div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-2">Humanité</h4>
                        <p class="text-gray-500 font-light text-sm">Une relation de proximité et de confiance avec nos clients.</p>
                    </div>
                    <div class="p-6">
                        <div class="text-brand-gold text-4xl mb-4">💎</div>
                        <h4 class="font-bold uppercase tracking-widest text-sm mb-2">Excellence</h4>
                        <p class="text-gray-500 font-light text-sm">Une exigence de qualité journalistique et événementielle.</p>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="py-40 text-center">
            <h1 class="text-3xl text-red-500">Page non configurée</h1>
            <p>Allez dans l'Admin > Pages et créez une page avec la clé unique : <strong>about</strong></p>
        </div>
    @endif
</div>