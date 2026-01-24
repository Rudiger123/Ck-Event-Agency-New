<div class="bg-white min-h-screen">
    
    <!-- EN-TÊTE DE PAGE -->
    <div class="bg-brand-black py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">Actualités & Presse</h1>
        <p class="text-brand-gold uppercase tracking-widest text-sm">L'information par Cynthia Kenne</p>
    </div>

    <div class="container mx-auto px-6 py-16">
        
        <!-- BARRE DE RECHERCHE & FILTRES -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <!-- Recherche -->
            <div class="w-full md:w-1/3">
                <input wire:model.live.debounce.300ms="search" 
                       type="text" 
                       placeholder="Rechercher un article..." 
                       class="w-full border-b-2 border-gray-200 py-2 focus:outline-none focus:border-brand-gold transition placeholder-gray-400">
            </div>

            <!-- Catégories -->
            <div class="flex flex-wrap gap-4 justify-center">
                <button wire:click="$set('category_id', '')" 
                        class="text-sm uppercase tracking-wider {{ $category_id == '' ? 'text-brand-gold font-bold' : 'text-gray-500 hover:text-brand-black' }}">
                    Tout
                </button>
                @foreach($categories as $category)
                    <button wire:click="$set('category_id', {{ $category->id }})" 
                            class="text-sm uppercase tracking-wider {{ $category_id == $category->id ? 'text-brand-gold font-bold' : 'text-gray-500 hover:text-brand-black' }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- GRILLE D'ARTICLES -->
        @if($articles->count() > 0)
            <div class="grid md:grid-cols-3 gap-10">
                @foreach($articles as $article)
                <article class="group cursor-pointer flex flex-col h-full shadow-sm hover:shadow-xl transition-all duration-300 bg-white rounded-sm overflow-hidden border border-gray-100">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-64">
                        <a href="{{ route('blog.show', $article->slug) }}">
                            <img src="{{ $article->getFirstMediaUrl('featured_image') }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        </a>
                        <!-- Badges Média -->
                        @if($article->hasMedia('video'))
                            <div class="absolute top-4 right-4 bg-brand-black/80 backdrop-blur text-white p-2 rounded-full border border-white/20">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"/></svg>
                            </div>
                        @endif
                    </div>

                    <!-- Contenu -->
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="text-brand-gold text-xs uppercase tracking-widest mb-3 font-bold">
                            {{ $article->category->name ?? 'Actualité' }}
                        </div>
                        <h3 class="text-xl font-serif font-bold text-brand-black mb-3 group-hover:text-brand-gold transition leading-tight">
                            <a href="{{ route('blog.show', $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-500 font-light text-sm line-clamp-3 mb-6 flex-grow">
                            {{ $article->excerpt }}
                        </p>
                        <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs text-gray-400">{{ $article->published_at?->translatedFormat('d F Y') }}</span>
                            <a href="{{ route('blog.show', $article->slug) }}" class="text-xs font-bold uppercase tracking-widest text-brand-black group-hover:underline">Lire</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination Custom -->
            <div class="mt-16">
                {{ $articles->links('vendor.pagination.custom') }}
            </div>
        @else
            <!-- MESSAGE "AUCUN RÉSULTAT" -->
            <div class="text-center py-20 bg-gray-50 rounded border border-gray-100">
                <div class="text-6xl mb-6">🔍</div>
                <h3 class="text-2xl font-serif font-bold text-brand-black mb-2">Aucun article trouvé</h3>
                <p class="text-gray-500">
                    Nous n'avons trouvé aucun résultat pour votre recherche. <br> Essayez d'autres mots-clés ou changez de catégorie.
                </p>
                <button wire:click="$set('search', '')" class="mt-6 text-brand-gold font-bold uppercase text-xs tracking-widest hover:underline">
                    Réinitialiser la recherche
                </button>
            </div>
        @endif
</div>