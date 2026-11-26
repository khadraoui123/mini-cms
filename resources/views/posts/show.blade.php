<x-layout>
    <x-slot:title>{{ $post->title }} - Mini-CMS</x-slot:title>

    <a href="{{ route('posts.index') }}" class="inline-flex animate-fade-in items-center gap-2 text-sm font-semibold text-indigo-600 transition-all duration-300 hover:gap-3 hover:scale-105 hover:text-indigo-800">
        <span aria-hidden="true">←</span>
        Retour aux articles
    </a>

    <div class="mt-6 grid gap-8 lg:grid-cols-3">
        <article class="group anim-fade-in lg:col-span-2 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
            <div class="relative h-64 overflow-hidden bg-gray-100 sm:h-80">
                <x-post-thumbnail :post="$post" variant="hero" />

                @if (! $post->is_published)
                    <span class="absolute right-6 top-6 z-10 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-800">Brouillon</span>
                @endif
            </div>

            <div class="px-6 py-10 sm:px-10 sm:py-12">
                <h1 class="anim-fade-up text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl" style="animation-delay: 100ms">{{ $post->title }}</h1>

                <div class="mt-4 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-gray-500">
                    <span class="inline-flex items-center gap-2">
                        <i class="fa-regular fa-clock text-indigo-500" aria-hidden="true"></i>
                        {{ $readingTime }} min de lecture
                    </span>
                    <span class="inline-flex items-center gap-2">
                        <i class="fa-regular fa-calendar text-indigo-500" aria-hidden="true"></i>
                        {{ $wordCount }} mots
                    </span>
                    @if ($post->published_at)
                        <span class="inline-flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-500" aria-hidden="true"></i>
                            Publié le {{ $post->published_at->format('d/m/Y') }}
                        </span>
                    @endif
                </div>

                @if ($post->tags->isNotEmpty())
                    <ul class="mt-6 flex flex-wrap gap-2" aria-label="Tags de l'article">
                        @foreach ($post->tags as $tag)
                            <li>
                                <a href="{{ route('posts.tag', $tag) }}" class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700 transition hover:bg-indigo-100">
                                    <i class="fa-solid fa-hashtag text-[10px]" aria-hidden="true"></i>
                                    {{ $tag->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if ($post->excerpt)
                    <p class="mt-8 border-l-4 border-indigo-200 pl-5 text-lg leading-relaxed text-gray-600">{{ $post->excerpt }}</p>
                @endif

                <div class="mt-8 space-y-5 whitespace-pre-line text-base leading-8 text-gray-800 sm:text-lg">{{ $post->body }}</div>

                @can('update', $post)
                    <div class="mt-10 flex flex-wrap items-center gap-3 border-t border-gray-200 pt-6">
                        <form method="POST" action="{{ route('posts.publication', $post) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">{{ $post->is_published ? 'Dépublier' : 'Publier' }}</button>
                        </form>
                        <a href="{{ route('posts.edit', $post) }}" class="rounded-full border border-indigo-200 px-4 py-2 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-50">Modifier</a>
                        @can('delete', $post)
                            <details>
                                <summary class="cursor-pointer rounded-full border border-red-200 px-4 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-50">Supprimer</summary>
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" class="mt-3 rounded-2xl border border-red-200 bg-red-50 p-4">
                                    @csrf
                                    @method('DELETE')
                                    <p class="mb-3 text-sm text-red-900">Cette action est définitive : l'article sera effacé de la base.</p>
                                    <button type="submit" class="rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Confirmer la suppression</button>
                                </form>
                            </details>
                        @endcan
                    </div>
                @endcan
            </div>
        </article>

        <aside class="anim-fade-in space-y-6 lg:col-span-1" style="animation-delay: 100ms" aria-label="Informations sur l'article">
            <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    <i class="fa-solid fa-user text-indigo-500" aria-hidden="true"></i>
                    Auteur
                </h2>
                <div class="mt-4 flex items-center gap-3">
                    <span class="grid size-12 shrink-0 place-items-center rounded-full bg-linear-to-br from-indigo-500 to-violet-600 text-sm font-bold text-white shadow-sm">{{ Str::upper(Str::substr($post->user?->name ?? '?', 0, 1)) }}</span>
                    <div>
                        <p class="font-semibold text-gray-900">{{ $post->user?->name ?? 'auteur inconnu' }}</p>
                        <p class="text-xs text-gray-500">{{ $post->user?->isAdmin() ? 'Administrateur' : 'Rédacteur' }}</p>
                    </div>
                </div>

                <dl class="mt-6 space-y-4 border-t border-gray-100 pt-5 text-sm">
                    <div class="flex items-start justify-between gap-3">
                        <dt class="text-gray-500">Date</dt>
                        <dd class="text-right font-medium text-gray-900">
                            @if ($post->published_at)
                                <a href="{{ route('posts.archive', $post->published_at->year) }}" class="transition-colors hover:text-indigo-600 hover:underline">{{ $post->published_at->format('d/m/Y') }}</a>
                            @else
                                Non publié
                            @endif
                        </dd>
                    </div>
                    <div class="flex items-start justify-between gap-3">
                        <dt class="text-gray-500">Catégorie</dt>
                        <dd class="text-right font-medium text-gray-900">
                            @if ($post->category)
                                <a href="{{ route('posts.category', $post->category) }}" class="transition-colors hover:text-indigo-600 hover:underline">{{ $post->category->name }}</a>
                            @else
                                Sans catégorie
                            @endif
                        </dd>
                    </div>
                    <div class="flex items-start justify-between gap-3">
                        <dt class="text-gray-500">Lecture</dt>
                        <dd class="text-right font-medium text-gray-900">{{ $readingTime }} min</dd>
                    </div>
                    <div class="flex items-start justify-between gap-3">
                        <dt class="text-gray-500">Longueur</dt>
                        <dd class="text-right font-medium text-gray-900">{{ $wordCount }} mots</dd>
                    </div>
                    <div class="flex items-start justify-between gap-3">
                        <dt class="text-gray-500">Statut</dt>
                        <dd>
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $post->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $post->is_published ? 'Publié' : 'Brouillon' }}</span>
                        </dd>
                    </div>
                </dl>
            </section>

            @if ($related->isNotEmpty())
                <section class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm" aria-labelledby="related-title">
                    <p class="flex items-center gap-2 text-sm font-semibold uppercase tracking-wider text-indigo-600">
                        <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                        À lire aussi
                    </p>
                    <h2 id="related-title" class="mt-1 text-lg font-bold tracking-tight text-gray-900">Dans la même catégorie</h2>

                    <ul class="mt-5 space-y-4">
                        @foreach ($related as $relatedPost)
                            <li class="flex anim-scale-in gap-3" style="animation-delay: {{ ($loop->index + 1) * 100 }}ms">
                                <a href="{{ route('posts.show', $relatedPost) }}" class="size-16 shrink-0 overflow-hidden rounded-lg" aria-label="Lire {{ $relatedPost->title }}">
                                    <x-post-thumbnail :post="$relatedPost" variant="thumb" />
                                </a>
                                <div>
                                    <a href="{{ route('posts.show', $relatedPost) }}" class="line-clamp-2 text-sm font-semibold leading-snug text-gray-900 transition-colors hover:text-indigo-600">{{ $relatedPost->title }}</a>
                                    <p class="mt-1 text-xs text-gray-500">{{ $relatedPost->published_at?->format('d/m/Y') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif
        </aside>
    </div>
</x-layout>
