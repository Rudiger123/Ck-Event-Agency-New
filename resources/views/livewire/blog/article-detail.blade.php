<div class="bg-white min-h-screen pt-20">
    
    <article class="container mx-auto px-6 py-12 max-w-4xl">
        
        <!-- EN-TÊTE -->
        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-2 text-xs uppercase tracking-widest text-gray-500 mb-4">
                <span>{{ $article->published_at?->translatedFormat('d F Y') }}</span>
                @if($article->category)
                    <span class="text-brand-gold">• {{ $article->category->name }}</span>
                @endif
            </div>
            <h1 class="text-3xl md:text-5xl font-serif font-bold text-brand-black leading-tight mb-8">
                {{ $article->title }}
            </h1>
        </div>

        <!-- AFFICHAGE MÉDIA (Vidéo > Audio > Image) -->
        <div class="mb-12 shadow-2xl rounded-sm overflow-hidden bg-gray-50 group">
            @if($article->hasMedia('video'))
                <video controls class="w-full aspect-video">
                    <source src="{{ $article->getFirstMediaUrl('video') }}" type="video/mp4">
                </video>
            @elseif($article->hasMedia('audio'))
                <img src="{{ $article->getFirstMediaUrl('featured_image') }}" class="w-full h-auto object-cover">
                <div class="bg-brand-black p-4 flex justify-center">
                    <audio controls class="w-full max-w-md"><source src="{{ $article->getFirstMediaUrl('audio') }}" type="audio/mpeg"></audio>
                </div>
            @else
                <img src="{{ $article->getFirstMediaUrl('featured_image') }}" class="w-full h-auto max-h-[600px] object-cover transition duration-700 group-hover:scale-105">
            @endif
        </div>

        <!-- CONTENU -->
        <div class="prose prose-lg max-w-none prose-headings:font-serif prose-headings:text-brand-black prose-a:text-brand-gold text-gray-700 leading-relaxed font-sans mb-12">
            {!! $article->content !!}
        </div>

        <!-- BARRE D'ACTION (LIKE & PARTAGE) -->
        <div class="border-t border-b border-gray-100 py-8 mb-12 flex flex-col md:flex-row justify-between items-center gap-6">
            
            <!-- BOUTON LIKE -->
            <button wire:click="toggleLike" 
                    class="flex items-center gap-2 px-6 py-2 rounded-full transition duration-300 {{ $hasLiked ? 'bg-red-50 text-red-500 border border-red-200' : 'bg-gray-50 text-gray-500 hover:bg-red-50 hover:text-red-500' }}">
                <svg class="w-6 h-6 transition-transform duration-300 {{ $hasLiked ? 'fill-current scale-110' : 'fill-none stroke-current' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="font-bold text-sm">{{ $article->likes }} J'aime</span>
            </button>

            <!-- ICÔNES DE PARTAGE SVG STYLÉES -->
            <div class="flex items-center gap-4">
                <span class="text-xs uppercase tracking-widest text-gray-400">Partager :</span>
                
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" 
                   class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-100 text-gray-600 hover:bg-[#1877F2] hover:text-white transition duration-300 transform hover:-translate-y-1">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank" 
                   class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-100 text-gray-600 hover:bg-[#0A66C2] hover:text-white transition duration-300 transform hover:-translate-y-1">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h5v-8.368c0-4.754 5.5-5.163 5.5 1.5v6.868h5v-9.258c0-7.542-8.356-7.86-10.532-3.793v-3.917z"/></svg>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank" 
                   class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-100 text-gray-600 hover:bg-[#25D366] hover:text-white transition duration-300 transform hover:-translate-y-1">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                </a>
            </div>
        </div>

        <!-- ZONE COMMENTAIRES -->
        <div class="bg-gray-50 p-8 md:p-12 rounded-sm border border-gray-100">
            <h3 class="text-2xl font-serif font-bold text-brand-black mb-8">Commentaires ({{ $comments->count() }})</h3>
            
            <!-- Liste des commentaires -->
            <div class="space-y-8 mb-12">
                @foreach($comments as $comment)
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-brand-gold/20 text-brand-gold flex items-center justify-center font-bold uppercase">
                        {{ substr($comment->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-bold text-sm">{{ $comment->name }}</span>
                            <span class="text-xs text-gray-400">• {{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $comment->content }}</p>
                    </div>
                </div>
                @endforeach

                @if($comments->isEmpty())
                    <p class="text-gray-400 italic text-sm">Soyez le premier à commenter cet article.</p>
                @endif
            </div>

            <!-- Formulaire -->
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-brand-gold mb-6">Laisser un commentaire</h4>
                
                @if($commentSuccess)
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-sm border border-green-200">
                        Merci ! Votre commentaire a été envoyé et sera visible après validation.
                    </div>
                @endif

                <form wire:submit="submitComment" class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <input wire:model="commentName" type="text" placeholder="Votre Nom *" 
                                   class="w-full border-gray-200 p-3 text-sm focus:border-brand-gold focus:ring-0">
                            @error('commentName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <input wire:model="commentEmail" type="email" placeholder="Votre Email (non publié) *" 
                                   class="w-full border-gray-200 p-3 text-sm focus:border-brand-gold focus:ring-0">
                            @error('commentEmail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <textarea wire:model="commentContent" rows="4" placeholder="Votre message..." 
                                  class="w-full border-gray-200 p-3 text-sm focus:border-brand-gold focus:ring-0"></textarea>
                        @error('commentContent') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-brand-black text-white px-8 py-3 uppercase tracking-widest text-xs font-bold hover:bg-brand-gold transition duration-300">
                        Poster le commentaire
                    </button>
                </form>
            </div>
        </div>

    </article>
</div>