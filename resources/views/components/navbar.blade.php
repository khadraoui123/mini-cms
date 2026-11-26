<header id="site-header" class="sticky top-0 z-50 border-b border-transparent bg-transparent transition-all duration-300">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8" aria-label="Navigation principale">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5" aria-label="Mini-CMS, retour à l'accueil">
            <span class="grid size-9 place-items-center rounded-xl bg-linear-to-br from-indigo-600 to-violet-600 text-sm font-bold text-white shadow-md shadow-indigo-200">MC</span>
            <span class="text-lg font-bold tracking-tight text-gray-900">Mini<span class="text-indigo-600">CMS</span></span>
        </a>

        <div class="hidden items-center gap-1 md:flex">
            <x-nav-link to="home">Accueil</x-nav-link>
            <x-nav-link to="posts.index" match="posts.*">Articles</x-nav-link>
            <x-nav-link to="dashboard">Dashboard</x-nav-link>
            <x-nav-link to="about">À propos</x-nav-link>
            @can('manage-categories')
                <x-nav-link to="admin.categories.index" match="admin.categories.*">Catégories</x-nav-link>
            @endcan
            @can('manage-tags')
                <x-nav-link to="admin.tags.index" match="admin.tags.*">Tags</x-nav-link>
            @endcan
            @can('manage-users')
                <x-nav-link to="admin.users.index" match="admin.users.*">Utilisateurs</x-nav-link>
            @endcan
        </div>

        <div class="hidden items-center gap-2 md:flex">
            @auth
                <a href="{{ route('posts.create') }}" class="shine rounded-full bg-linear-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:scale-105 hover:shadow-lg">Écrire un article</a>
                <x-nav-link to="my-posts">Mes articles</x-nav-link>
                <details class="relative ml-1 border-l border-gray-200 pl-3">
                    <summary class="flex cursor-pointer list-none items-center gap-2 rounded-xl px-1 py-1 transition hover:bg-gray-100 [&::-webkit-details-marker]:hidden" aria-label="Ouvrir le menu du profil">
                        <span class="grid size-8 place-items-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700">{{ Str::upper(Str::substr(auth()->user()->name, 0, 1)) }}</span>
                        <span class="max-w-28 truncate text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-xs text-gray-400" aria-hidden="true"></i>
                    </summary>
                    <div class="absolute right-0 top-full z-50 mt-3 w-64 rounded-2xl border border-gray-200 bg-white p-2 shadow-xl">
                        <x-nav-link to="my-posts" class="block w-full">Mes articles</x-nav-link>
                        @can('manage-users')
                            <x-nav-link to="admin.users.index" match="admin.users.*" class="block w-full">Gestion des utilisateurs</x-nav-link>
                        @endcan
                        <div class="my-2 border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-md px-3 py-2 text-left text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900">Déconnexion</button>
                        </form>
                    </div>
                </details>
            @endauth
            @guest
                <x-nav-link to="login">Connexion</x-nav-link>
                <a href="{{ route('register') }}" class="shine rounded-full bg-linear-to-r from-indigo-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:scale-105 hover:shadow-lg">Inscription</a>
            @endguest
        </div>

        <details class="relative md:hidden">
            <summary class="grid size-10 cursor-pointer list-none place-items-center rounded-xl border border-gray-200 bg-white text-gray-700 shadow-xs [&::-webkit-details-marker]:hidden" aria-label="Ouvrir le menu de navigation">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </summary>
            <div id="mobile-navigation" class="absolute right-0 top-full z-50 mt-3 w-72 rounded-2xl border border-gray-200 bg-white p-2 shadow-xl">
                <x-nav-link to="home" class="block w-full">Accueil</x-nav-link>
                <x-nav-link to="posts.index" match="posts.*" class="block w-full">Articles</x-nav-link>
                <x-nav-link to="dashboard" class="block w-full">Dashboard</x-nav-link>
                <x-nav-link to="about" class="block w-full">À propos</x-nav-link>
                @can('manage-categories')
                    <x-nav-link to="admin.categories.index" match="admin.categories.*" class="block w-full">Catégories</x-nav-link>
                @endcan
                @can('manage-tags')
                    <x-nav-link to="admin.tags.index" match="admin.tags.*" class="block w-full">Tags</x-nav-link>
                @endcan
                @can('manage-users')
                    <x-nav-link to="admin.users.index" match="admin.users.*" class="block w-full">Utilisateurs</x-nav-link>
                @endcan

                <div class="my-2 border-t border-gray-100"></div>

                @auth
                    <a href="{{ route('posts.create') }}" class="shine block rounded-md bg-linear-to-r from-indigo-600 to-violet-600 px-3 py-2 text-sm font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-md">Écrire un article</a>
                    <x-nav-link to="my-posts" class="block w-full">Mes articles</x-nav-link>
                    <p class="px-3 py-2 text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                    <form method="POST" action="{{ route('logout') }}" class="px-1 pb-1">
                        @csrf
                        <button type="submit" class="w-full rounded-md px-2 py-2 text-left text-sm font-medium text-red-600 transition hover:bg-red-50">Déconnexion</button>
                    </form>
                @endauth
                @guest
                    <x-nav-link to="login" class="block w-full">Connexion</x-nav-link>
                    <x-nav-link to="register" class="block w-full">Inscription</x-nav-link>
                @endguest
            </div>
        </details>
    </nav>
</header>
