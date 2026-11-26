<x-layout>
    <x-slot:title>Accueil - Mini-CMS</x-slot:title>

    <section class="relative animate-fade-in-up overflow-hidden rounded-3xl bg-linear-to-br from-indigo-600 via-violet-600 to-fuchsia-600 px-6 py-14 text-white shadow-xl shadow-indigo-200 sm:px-12 sm:py-20">
        <div class="pointer-events-none absolute -right-20 -top-24 size-72 rounded-full bg-white/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 left-1/3 size-72 rounded-full bg-fuchsia-300/20 blur-3xl"></div>

        <div id="hero-copy" class="relative max-w-3xl will-change-transform">
            <span class="anim-fade-in inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-wider ring-1 ring-white/30" style="animation-delay: 50ms">
                Atelier Framework Côté Serveur · ISET Sidi Bouzid
            </span>
            <h1 class="anim-fade-up mt-6 text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl" style="animation-delay: 100ms">
                Des idées claires, des articles qui vont droit au but.
            </h1>
            <p class="anim-fade-in mt-5 max-w-2xl text-lg leading-relaxed text-indigo-100" style="animation-delay: 200ms">
                Découvrez des tutoriels concrets sur Laravel, le front-end et les bases de données, écrits par les étudiants de Mini-CMS.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('posts.index') }}" class="shine shine-light inline-flex animate-glow items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-indigo-700 shadow-md transition-all duration-300 hover:-translate-y-0.5 hover:scale-105 hover:bg-indigo-50">
                    Lire les articles
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                @auth
                    <a href="{{ route('posts.create') }}" class="shine shine-light inline-flex items-center rounded-full bg-white/15 px-6 py-3 text-sm font-semibold text-white ring-1 ring-white/40 transition-all duration-300 hover:scale-105 hover:bg-white/25">Écrire un article</a>
                @endauth
            </div>
        </div>
    </section>

    <section class="mt-14 animate-fade-in" aria-labelledby="categories-title">
        <p class="anim-fade-in text-sm font-semibold uppercase tracking-wider text-indigo-600" style="animation-delay: 100ms">Explorer</p>
        <h2 id="categories-title" class="anim-fade-up mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" style="animation-delay: 150ms">Parcourir par catégorie</h2>

        <ul class="mt-6 flex flex-wrap gap-3">
            @foreach ($categories as $category)
                @php
                    $badgeStyles = [
                        'laravel' => 'border-red-200 bg-red-50 text-red-700',
                        'frontend' => 'border-sky-200 bg-sky-50 text-sky-700',
                        'base-de-donnees' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                        'default' => 'border-gray-200 bg-white text-gray-700',
                    ];
                    $badgeClass = $badgeStyles[$category->slug] ?? $badgeStyles['default'];
                @endphp
                <li>
                    <a href="{{ route('posts.category', $category) }}" class="anim-scale-in inline-flex items-center rounded-full border px-4 py-2 text-sm font-semibold shadow-xs transition-all duration-300 hover:-translate-y-0.5 hover:scale-105 hover:shadow-md {{ $badgeClass }}" style="animation-delay: {{ 200 + $loop->index * 50 }}ms">
                        {{ $category->name }} ({{ $category->posts_count }})
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

    @if ($tags->isNotEmpty())
        <section class="mt-12 animate-fade-in" aria-labelledby="tags-title">
            <h2 id="tags-title" class="anim-fade-up text-lg font-semibold text-gray-900" style="animation-delay: 100ms">Tags populaires</h2>
            <ul class="mt-4 flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <li>
                        <a href="{{ route('posts.tag', $tag) }}" class="anim-scale-in inline-flex items-center rounded-full bg-white px-3 py-1.5 text-sm font-medium text-gray-700 shadow-xs ring-1 ring-gray-200 transition-all duration-300 hover:scale-105 hover:border-indigo-200 hover:text-indigo-600 hover:shadow-md" style="animation-delay: {{ 150 + $loop->index * 50 }}ms">
                            #{{ $tag->name }} ({{ $tag->posts_count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    <section class="mt-14 animate-fade-in" aria-labelledby="latest-title">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="anim-fade-in text-sm font-semibold uppercase tracking-wider text-indigo-600" style="animation-delay: 100ms">À la une</p>
                <h2 id="latest-title" class="anim-fade-up mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" style="animation-delay: 150ms">Derniers articles publiés</h2>
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

    <script>
        const heroCopy = document.getElementById('hero-copy');
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(() => {
                const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                heroCopy.style.transform = reduced ? '' : `translate3d(0, ${Math.min(window.scrollY, 400) * 0.12}px, 0)`;
                ticking = false;
            });
        }, { passive: true });
    </script>
</x-layout>
