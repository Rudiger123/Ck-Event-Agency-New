<div class="w-full">
    @if($subscribed)
        <div class="bg-green-900/50 text-green-200 p-4 rounded border border-green-700 text-center animate-pulse">
            <p class="font-serif">Merci ! Vous êtes inscrit.</p>
        </div>
    @else
        <h5 class="text-brand-gold font-serif font-bold mb-4 uppercase tracking-widest text-xs">Newsletter</h5>
        <p class="text-gray-500 text-sm mb-4">Recevez nos dernières actualités et invitations.</p>
        
        <form wire:submit="subscribe" class="flex flex-col gap-2">
            <input wire:model="email" type="email" placeholder="Votre email..." 
                   class="bg-gray-800 border border-gray-700 text-white px-4 py-3 text-sm focus:outline-none focus:border-brand-gold w-full transition">
            
            @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror

            <button type="submit" class="bg-brand-gold text-brand-black font-bold uppercase tracking-widest text-xs py-3 hover:bg-white transition duration-300">
                S'inscrire
            </button>
        </form>
    @endif
</div>