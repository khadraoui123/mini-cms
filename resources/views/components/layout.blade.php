<!DOCTYPE html>
<html lang="fr" class="h-full scroll-smooth bg-[#f7f8fd]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mini-CMS : tutoriels et articles sur Laravel, le front-end et les bases de données.">
    <title>{{ $title ?? 'Mini-CMS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full font-sans text-gray-900 antialiased">
    <x-mesh-background />

    <div class="relative z-10 flex min-h-screen flex-col">
        <x-navbar />

        <main class="flex-1">
            <div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
                @if (config('site.read_only'))
                    <x-alert type="warning" title="Site en lecture seule" class="mb-6">
                        Les modifications sont temporairement désactivées.
                    </x-alert>
                @endif

                @if (session('success'))
                    <x-alert type="success" class="mb-6">{{ session('success') }}</x-alert>
                @endif

                {{ $slot }}
            </div>
        </main>

        <footer class="border-t border-gray-200 bg-white">
            <div class="mx-auto grid w-full max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-3 lg:px-8">
                <div>
                    <div class="flex items-center gap-2.5">
                        <span class="grid size-9 place-items-center rounded-xl bg-linear-to-br from-indigo-600 to-violet-600 text-sm font-bold text-white shadow-md shadow-indigo-200">MC</span>
                        <span class="text-lg font-bold tracking-tight text-gray-900">Mini<span class="text-indigo-600">CMS</span></span>
                    </div>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed text-gray-600">
                        Une plateforme de publication simple et moderne, construite pas à pas pendant l'atelier.
                    </p>
                </div>

                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Navigation</h2>
                    <ul class="mt-4 space-y-2 text-sm text-gray-600">
                        <li><a href="{{ route('home') }}" class="transition-colors hover:text-indigo-600">Accueil</a></li>
                        <li><a href="{{ route('posts.index') }}" class="transition-colors hover:text-indigo-600">Articles</a></li>
                        <li><a href="{{ route('about') }}" class="transition-colors hover:text-indigo-600">À propos</a></li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Atelier</h2>
                    <p class="mt-4 text-sm leading-relaxed text-gray-600">
                        Framework Côté Serveur — ISET Sidi Bouzid.
                    </p>
                </div>
            </div>
            <div class="border-t border-gray-100 py-5 text-center text-sm text-gray-500">
                © {{ now()->year }} Mini-CMS. Tous droits réservés.
            </div>
        </footer>
    </div>

    <button
        type="button"
        id="back-to-top"
        aria-label="Retour en haut de la page"
        title="Retour en haut"
        class="pointer-events-none fixed bottom-6 right-6 z-50 grid size-11 translate-y-2 place-items-center rounded-full bg-indigo-600 text-white opacity-0 shadow-lg shadow-indigo-200 transition-all duration-300 hover:scale-105 hover:bg-indigo-700 focus-visible:opacity-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >
        <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
    </button>

    <script>
        const backToTop = document.getElementById('back-to-top');

        const toggleBackToTop = () => {
            const isVisible = window.scrollY > 300;

            backToTop.classList.toggle('opacity-100', isVisible);
            backToTop.classList.toggle('opacity-0', ! isVisible);
            backToTop.classList.toggle('translate-y-0', isVisible);
            backToTop.classList.toggle('translate-y-2', ! isVisible);
            backToTop.classList.toggle('pointer-events-none', ! isVisible);
            backToTop.tabIndex = isVisible ? 0 : -1;
        };

        window.addEventListener('scroll', toggleBackToTop, { passive: true });
        toggleBackToTop();

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const siteHeader = document.getElementById('site-header');
        const solidHeaderClasses = ['bg-white/80', 'backdrop-blur-md', 'shadow-sm', 'border-white/40'];
        const clearHeaderClasses = ['bg-transparent', 'border-transparent'];

        const toggleSiteHeader = () => {
            const scrolled = window.scrollY > 50;

            siteHeader.classList[scrolled ? 'add' : 'remove'](...solidHeaderClasses);
            siteHeader.classList[scrolled ? 'remove' : 'add'](...clearHeaderClasses);
        };

        window.addEventListener('scroll', toggleSiteHeader, { passive: true });
        toggleSiteHeader();
    </script>
</body>
</html>
