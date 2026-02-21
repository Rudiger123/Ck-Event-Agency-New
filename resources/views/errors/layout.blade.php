<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | CK Event Agency</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="{{ asset('images/favicon.jpg') }}">


    <!-- Tailwind (On utilise le CDN pour être sûr que ça charge même si Vite a un problème) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            black: '#121212',
                            gold: '#C9A961',
                        }
                    },
                    fontFamily: {
                        sans: ['Lato', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-brand-black font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-6 text-center">
        
        <!-- Logo -->
        <div class="mb-12">
            <a href="/" class="text-3xl font-serif font-bold tracking-widest">
                CK <span class="text-brand-gold">AGENCY</span>
            </a>
        </div>

        <!-- Code Erreur -->
        <h1 class="text-9xl font-serif font-bold text-gray-100 absolute z-0 select-none">
            @yield('code')
        </h1>

        <!-- Contenu -->
        <div class="relative z-10">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">
                @yield('message')
            </h2>
            <p class="text-gray-500 text-lg mb-10 max-w-md mx-auto font-light">
                @yield('description')
            </p>
            
            <a href="/" class="inline-block px-10 py-4 bg-brand-black text-white text-xs font-bold uppercase tracking-widest hover:bg-brand-gold transition duration-300 shadow-xl">
                Retour à l'accueil
            </a>
        </div>

        <!-- Signature -->
        <div class="mt-20 text-gray-400 text-xs uppercase tracking-[0.3em]">
            &copy; {{ date('Y') }} CK Event Agency
        </div>
    </div>
</body>
</html>