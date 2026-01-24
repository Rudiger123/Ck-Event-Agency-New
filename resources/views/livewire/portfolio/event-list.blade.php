<div class="bg-brand-black min-h-screen text-white">
    
    <!-- EN-TÊTE -->
    <div class="py-24 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-brand-gold opacity-5"></div> <!-- Légère teinte dorée -->
        <h1 class="text-4xl md:text-6xl font-serif font-bold mb-4 relative z-10">Nos Réalisations</h1>
        <p class="text-gray-400 uppercase tracking-widest text-sm relative z-10">Des moments d'exception signés Cynthia Kenne</p>
    </div>

    <div class="container mx-auto px-6 pb-20">
        
        <!-- FILTRES -->
        <div class="flex flex-wrap justify-center gap-6 mb-16">
            <button wire:click="$set('type_id', '')" 
                    class="text-sm uppercase tracking-widest transition border-b-2 pb-1 {{ $type_id == '' ? 'text-brand-gold border-brand-gold' : 'text-gray-500 border-transparent hover:text-white' }}">
                Tout voir
            </button>
            @foreach($types as $type)
                <button wire:click="$set('type_id', {{ $type->id }})" 
                        class="text-sm uppercase tracking-widest transition border-b-2 pb-1 {{ $type_id == $type->id ? 'text-brand-gold border-brand-gold' : 'text-gray-500 border-transparent hover:text-white' }}">
                    {{ $type->name }}
                </button>
            @endforeach
        </div>

        <!-- GRILLE PROJETS -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
            <div class="group relative block overflow-hidden h-[450px] cursor-pointer">
                <!-- Lien global -->
                <a href="{{ route('portfolio.show', $event->slug) }}" class="absolute inset-0 z-20"></a>

                <!-- Image -->
                <img src="{{ $event->getFirstMediaUrl('cover_image') }}" 
                     alt="{{ $event->title }}" 
                     class="w-full h-full object-cover transition duration-1000 group-hover:scale-110 group-hover:opacity-60">
                
                <!-- Overlay Texte -->
                <div class="absolute inset-0 flex flex-col justify-end p-8 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-90 transition duration-500">
                    
                    <div class="transform translate-y-4 group-hover:translate-y-0 transition duration-500">
                        @if($event->eventType)
                            <span class="text-brand-gold text-xs uppercase tracking-widest mb-2 block">
                                {{ $event->eventType->name }}
                            </span>
                        @endif
                        
                        <h3 class="text-2xl font-serif font-bold text-white mb-2">
                            {{ $event->title }}
                        </h3>
                        
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                            {{ Str::limit(strip_tags($event->description), 100) }}
                        </p>

                        <span class="inline-block text-white text-xs uppercase tracking-widest border-b border-brand-gold pb-1">
                            Voir la galerie
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-16 text-white">
            {{ $events->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>