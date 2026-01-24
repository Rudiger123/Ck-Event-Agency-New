<div class="bg-gray-50 min-h-screen py-20">
    <div class="container mx-auto px-6 max-w-3xl">
        
        <div class="bg-white shadow-xl rounded-sm p-8 md:p-12">
            
            <div class="text-center mb-10">
                <h1 class="text-3xl font-serif font-bold text-brand-black">Demande de Devis</h1>
                <p class="text-gray-500 mt-2">Parlez-nous de votre projet. Nous vous répondrons sous 24h.</p>
            </div>

            @if($success)
                <div class="bg-green-50 border border-green-200 text-green-700 p-8 text-center">
                    <div class="text-4xl mb-4">✅</div>
                    <h3 class="font-bold text-xl mb-2">Demande envoyée avec succès !</h3>
                    <p>Merci {{ $name }}, nous avons bien reçu votre demande.</p>
                    <a href="/" class="inline-block mt-6 text-brand-black underline font-bold">Retour à l'accueil</a>
                </div>
            @else
                <form wire:submit="submit" class="space-y-8">
                    
                    <!-- 1. VOS COORDONNÉES -->
                    <div class="bg-gray-50 p-6 rounded border border-gray-100">
                        <h3 class="text-brand-gold font-bold uppercase tracking-widest text-xs mb-4">1. Vos Coordonnées</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Nom Complet *</label>
                                <input wire:model="name" type="text" class="w-full border-gray-300 p-3 focus:border-brand-gold focus:ring-0">
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Email Pro *</label>
                                <input wire:model="email" type="email" class="w-full border-gray-300 p-3 focus:border-brand-gold focus:ring-0">
                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Téléphone *</label>
                                <input wire:model="phone" type="text" class="w-full border-gray-300 p-3 focus:border-brand-gold focus:ring-0">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Entreprise</label>
                                <input wire:model="company" type="text" class="w-full border-gray-300 p-3 focus:border-brand-gold focus:ring-0">
                            </div>
                        </div>
                    </div>

                    <!-- 2. TYPE DE SERVICE -->
                    <div>
                        <h3 class="text-brand-gold font-bold uppercase tracking-widest text-xs mb-4">2. Services souhaités</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <label class="flex items-center space-x-3 p-4 border border-gray-200 cursor-pointer hover:border-brand-gold transition bg-white">
                                <input wire:model="service_types" value="presse" type="checkbox" class="text-brand-gold focus:ring-brand-gold h-5 w-5">
                                <span class="text-sm font-bold">Relations Presse & Médias</span>
                            </label>
                            <label class="flex items-center space-x-3 p-4 border border-gray-200 cursor-pointer hover:border-brand-gold transition bg-white">
                                <input wire:model="service_types" value="redaction" type="checkbox" class="text-brand-gold focus:ring-brand-gold h-5 w-5">
                                <span class="text-sm font-bold">Rédaction / Contenu</span>
                            </label>
                            <label class="flex items-center space-x-3 p-4 border border-gray-200 cursor-pointer hover:border-brand-gold transition bg-white">
                                <input wire:model="service_types" value="event" type="checkbox" class="text-brand-gold focus:ring-brand-gold h-5 w-5">
                                <span class="text-sm font-bold">Communication Événementielle</span>
                            </label>
                            <label class="flex items-center space-x-3 p-4 border border-gray-200 cursor-pointer hover:border-brand-gold transition bg-white">
                                <input wire:model="service_types" value="impresariat" type="checkbox" class="text-brand-gold focus:ring-brand-gold h-5 w-5">
                                <span class="text-sm font-bold">Imprésariat / Présentation</span>
                            </label>
                        </div>
                        @error('service_types') <span class="text-red-500 text-xs block mt-2">Veuillez sélectionner au moins un service.</span> @enderror
                    </div>

                    <!-- 3. DÉTAILS -->
                    <div>
                        <h3 class="text-brand-gold font-bold uppercase tracking-widest text-xs mb-4">3. Détails du projet</h3>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Date estimée</label>
                                <input wire:model="event_date" type="date" class="w-full border-gray-300 p-3 focus:border-brand-gold focus:ring-0">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">Budget approximatif</label>
                                <select wire:model="budget" class="w-full border-gray-300 p-3 focus:border-brand-gold focus:ring-0 bg-white">
                                    <option value="">Sélectionner...</option>
                                    <option value="< 500k">< 500.000 FCFA</option>
                                    <option value="500k-1M">500k - 1 Million FCFA</option>
                                    <option value="1M-5M">1M - 5 Millions FCFA</option>
                                    <option value="> 5M">> 5 Millions FCFA</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Description détaillée *</label>
                            <textarea wire:model="message" rows="5" class="w-full border-gray-300 p-3 focus:border-brand-gold focus:ring-0" placeholder="Décrivez votre besoin, le contexte, vos attentes..."></textarea>
                            @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- BOUTON -->
                    <button type="submit" class="w-full bg-brand-black text-white font-bold py-4 uppercase tracking-widest hover:bg-brand-gold transition duration-300 shadow-lg">
                        Envoyer ma demande de devis
                        <span wire:loading class="ml-2">...</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>