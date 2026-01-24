<div class="bg-white min-h-screen pt-20">
    <div class="container mx-auto px-6 py-12">
        
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- INFO CONTACT (Gauche) -->
            <div class="lg:w-1/3">
                <h1 class="text-4xl font-serif font-bold text-brand-black mb-6">Parlons de votre projet</h1>
                <p class="text-gray-600 font-light mb-8">
                    Que ce soit pour une couverture médiatique, un article ou la présentation d'un événement, nous sommes à votre écoute.
                </p>

                <div class="space-y-6">
                    <!-- Exemple pour l'adresse -->
                    <div class="flex items-start gap-4">
                        <div class="bg-brand-gold/10 p-3 rounded-full text-brand-gold">📍</div>
                        <div>
                            <h4 class="font-bold text-sm uppercase">Adresse</h4>
                            <p class="text-gray-500 text-sm">
                                {{ \App\Models\Setting::value('site_address', 'Yaoundé, Cameroun') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="bg-brand-gold/10 p-3 rounded-full text-brand-gold">📧</div>
                        <div>
                            <h4 class="font-bold text-sm uppercase">Email</h4>
                            <p class="text-gray-500 text-sm">
                                {{ \App\Models\Setting::value('site_email', 'contact@ck-agency.com') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="bg-brand-gold/10 p-3 rounded-full text-brand-gold">📞</div>
                        <div>
                            <h4 class="font-bold text-sm uppercase">Téléphone</h4>
                            <p class="text-gray-500 text-sm">
                                {{ \App\Models\Setting::value('site_phone', '+237 00 00 00 00') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Réseaux sociaux -->
                <div class="mt-12">
                    <h4 class="font-bold text-sm uppercase mb-4">Suivez Cyn</h4>
                    <div class="flex gap-3">
                        <!-- Instagram avec tooltip -->
                        <a href="{{ \App\Models\Setting::value('url_instagram') }}" 
                           class="relative w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:bg-brand-black hover:text-white hover:border-brand-black transition-colors duration-200 group"
                           aria-label="Suivez-nous sur Instagram">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <circle cx="12" cy="12" r="5"/>
                                <circle cx="18" cy="6" r="1"/>
                            </svg>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                Instagram
                            </span>
                        </a>
                        
                        <!-- Facebook avec tooltip -->
                        <a href="{{ \App\Models\Setting::value('url_facebook') }}" 
                           class="relative w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:bg-brand-black hover:text-white hover:border-brand-black transition-colors duration-200 group"
                           aria-label="Suivez-nous sur Facebook">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                            </svg>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                Facebook
                            </span>
                        </a>
                        
                        <!-- LinkedIn avec tooltip -->
                        <a href="{{ \App\Models\Setting::value('url_linkedin') }}" 
                           class="relative w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:bg-brand-black hover:text-white hover:border-brand-black transition-colors duration-200 group"
                           aria-label="Suivez-nous sur LinkedIn">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/>
                                <rect x="2" y="9" width="4" height="12"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-gray-800 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                LinkedIn
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- FORMULAIRE (Droite) -->
            <div class="lg:w-2/3 bg-gray-50 p-8 md:p-12 rounded-sm shadow-sm">
                
                @if($successMessage)
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                        {{ $successMessage }}
                    </div>
                @endif

                <form wire:submit="submit" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nom Complet</label>
                            <input wire:model="name" type="text" class="w-full bg-white border border-gray-200 p-3 focus:outline-none focus:border-brand-gold">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Email</label>
                            <input wire:model="email" type="email" class="w-full bg-white border border-gray-200 p-3 focus:outline-none focus:border-brand-gold">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Sujet</label>
                        <select wire:model="subject" class="w-full bg-white border border-gray-200 p-3 focus:outline-none focus:border-brand-gold">
                            <option value="">Choisir un sujet...</option>
                            <option value="presse">Couverture Presse / Article</option>
                            <option value="event">Présentation Événement (Impresariat)</option>
                            <option value="partenariat">Partenariat</option>
                            <option value="autre">Autre demande</option>
                        </select>
                        @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Message</label>
                        <textarea wire:model="message" rows="5" class="w-full bg-white border border-gray-200 p-3 focus:outline-none focus:border-brand-gold"></textarea>
                        @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-brand-black text-white py-4 uppercase tracking-widest text-xs font-bold hover:bg-brand-gold transition duration-300">
                        Envoyer le message
                        <span wire:loading class="ml-2">...</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>