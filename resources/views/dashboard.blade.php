<x-layout>
    <x-slot:title>Dashboard - Mini-CMS</x-slot:title>

    <section aria-labelledby="dashboard-title">
        <p class="anim-fade-in text-sm font-semibold uppercase tracking-wider text-indigo-600" style="animation-delay: 50ms">Vue d'ensemble</p>
        <h1 id="dashboard-title" class="anim-fade-up mt-1 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl" style="animation-delay: 100ms">Dashboard statistiques</h1>
        <p class="anim-fade-in mt-3 max-w-2xl text-base leading-relaxed text-gray-600" style="animation-delay: 200ms">
            Un aperçu rapide du contenu et des contributeurs de Mini-CMS.
        </p>
    </section>

    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="anim-scale-in rounded-2xl border border-gray-200 bg-white p-6 shadow-sm" style="animation-delay: 100ms">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Articles</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">{{ $postsCount }}</p>
                </div>
                <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-xs text-gray-500">Tous les articles enregistrés</p>
        </div>

        <div class="anim-scale-in rounded-2xl border border-gray-200 bg-white p-6 shadow-sm" style="animation-delay: 200ms">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Utilisateurs</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">{{ $usersCount }}</p>
                </div>
                <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM3 20a6 6 0 0 1 12 0H3ZM17 4.5a3 3 0 0 1 0 5.5M17.5 14.5a5.5 5.5 0 0 1 3.5 5.5h-4" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-xs text-gray-500">Membres inscrits sur le site</p>
        </div>

        <div class="anim-scale-in rounded-2xl border border-gray-200 bg-white p-6 shadow-sm" style="animation-delay: 300ms">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Catégories</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">{{ $categoriesCount }}</p>
                </div>
                <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-amber-50 text-amber-600 ring-1 ring-amber-100">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5 16.5 3.75H7.5L3.75 7.5v9L7.5 20.25h9l3.75-3.75v-9Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v7.5M8.25 12h7.5" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-xs text-gray-500">Rubriques du blog</p>
        </div>

        <div class="anim-scale-in rounded-2xl border border-gray-200 bg-white p-6 shadow-sm" style="animation-delay: 400ms">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500">Tags</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">{{ $tagsCount }}</p>
                </div>
                <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h13.5M5.25 15.75h13.5M9.75 3.75 7.5 20.25M16.5 3.75l-2.25 16.5" />
                    </svg>
                </span>
            </div>
            <p class="mt-4 text-xs text-gray-500">Mots-clés disponibles</p>
        </div>
    </div>

    <section class="mt-14 animate-fade-in" aria-labelledby="dashboard-latest-title">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="anim-fade-in text-sm font-semibold uppercase tracking-wider text-indigo-600" style="animation-delay: 100ms">Actualité</p>
                <h2 id="dashboard-latest-title" class="anim-fade-up mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" style="animation-delay: 150ms">3 derniers articles</h2>
            </div>
            <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800 hover:underline">Voir tous les articles →</a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($latestPosts as $post)
                <x-post-card :post="$post" :delay="$loop->index * 0.1" />
            @empty
                <x-alert type="info" title="Aucun article publié" class="sm:col-span-2 lg:col-span-3">
                    Les articles publiés apparaîtront ici.
                </x-alert>
            @endforelse
        </div>
    </section>
</x-layout>
