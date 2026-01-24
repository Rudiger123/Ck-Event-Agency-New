<div class="bg-white min-h-screen" x-data="{ lightboxOpen: false, activeImage: '' }">
    
    <!-- HERO DE L'ÉVÉNEMENT -->
    <div class="relative h-[60vh] w-full">
        <img src="{{ $event->getFirstMediaUrl('cover_image') }}" 
             class="w-full h-full object-cover" 
             alt="Cover">
        <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center px-4">
            @if($event->eventType)
                <span class="bg-brand-gold text-white px-4 py-1 text-xs uppercase tracking-widest mb-4">
                    {{ $event->eventType->name }}
                </span>
            @endif
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-4">
                {{ $event->title }}
            </h1>
            <p class="text-gray-200 text-lg">
                {{ $event->location }} • {{ $event->event_date->translatedFormat('F Y') }}
            </p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-16">
        
        <!-- DESCRIPTION & DÉTAILS -->
        <div class="grid md:grid-cols-3 gap-12 mb-20">
            <div class="md:col-span-2 prose prose-lg font-light text-gray-700">
                <h3 class="font-serif text-2xl text-brand-black mb-4">L'Histoire</h3>
                {!! $event->description !!}
            </div>

            <div class="bg-gray-50 p-8 h-fit border-l-4 border-brand-gold">
                <h3 class="font-serif text-xl mb-6">Détails du projet</h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex justify-between">
                        <span class="text-gray-500">Date</span>
                        <span class="font-bold">{{ $event->event_date->translatedFormat('d F Y') }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Lieu</span>
                        <span class="font-bold">{{ $event->location ?? 'Non spécifié' }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Client</span>
                        <span class="font-bold">{{ $event->client_name ?? 'Privé' }}</span>
                    </li>
                </ul>

                @if($event->testimonial)
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="italic text-gray-600">"{{ $event->testimonial }}"</p>
                </div>
                @endif
            </div>
        </div>

        <!-- GALERIE PHOTOS -->
        <h3 class="text-3xl font-serif text-center mb-10">Galerie Photos</h3>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <!-- On boucle sur la collection 'gallery' de Spatie -->
            @foreach($event->getMedia('gallery') as $media)
                <div class="relative group cursor-pointer overflow-hidden h-64 md:h-80"
                     @click="lightboxOpen = true; activeImage = '{{ $media->getUrl() }}'">
                    
                    <img src="{{ $media->getUrl() }}" 
                         alt="Gallery Image" 
                         class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                    
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-300 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <!-- LIGHTBOX (MODAL ZOOM) -->
    <div x-show="lightboxOpen" 
         style="display: none;"
         class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <!-- Bouton Fermer -->
        <button @click="lightboxOpen = false" class="absolute top-6 right-6 text-white hover:text-brand-gold">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Image Zoomée -->
        <img :src="activeImage" class="max-w-full max-h-[90vh] shadow-2xl rounded-sm" @click.outside="lightboxOpen = false">
    </div>
</div>