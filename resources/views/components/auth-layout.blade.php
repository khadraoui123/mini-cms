@props(['title' => 'Mini-CMS'])

<!DOCTYPE html>
<html lang="fr" class="h-full scroll-smooth bg-[#f7f8fd]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mini-CMS : connexion et inscription à l'atelier Framework Côté Serveur.">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full font-sans text-gray-900 antialiased">
    <x-mesh-background />

    <div class="relative z-10 flex min-h-screen items-center justify-center overflow-hidden bg-linear-to-br from-indigo-50/70 via-white/80 to-purple-50/70 px-4 py-12 sm:px-6">
        <div class="pointer-events-none absolute -left-24 -top-24 size-80 rounded-full bg-indigo-200/40 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -bottom-24 -right-24 size-80 rounded-full bg-purple-200/40 blur-3xl" aria-hidden="true"></div>

        <div class="relative w-full max-w-md anim-fade-up" style="animation-delay: 50ms">
            <a href="{{ route('home') }}" class="mx-auto mb-8 flex w-fit items-center gap-2.5 transition-all duration-300 hover:scale-105" aria-label="Mini-CMS, retour à l'accueil">
                <span class="grid size-10 place-items-center rounded-xl bg-linear-to-br from-indigo-600 to-violet-600 text-sm font-bold text-white shadow-md shadow-indigo-200">MC</span>
                <span class="text-lg font-bold tracking-tight text-gray-900">Mini<span class="text-indigo-600">CMS</span></span>
            </a>

            {{ $slot }}

            <p class="mt-8 text-center text-xs text-gray-500">Atelier Framework Côté Serveur · ISET Sidi Bouzid</p>
        </div>
    </div>
</body>
</html>
