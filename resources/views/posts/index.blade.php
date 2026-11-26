<x-layout>
    <x-slot:title>{{ $heading }} - Mini-CMS</x-slot:title>

    <x-page-header :title="$heading" subtitle="Tous les articles disponibles, avec leurs auteurs, catégories et tags." />

    @if (request()->routeIs('posts.index'))
        <form method="GET" action="{{ route('posts.index') }}" class="anim-fade-in mb-8 rounded-2xl border border-gray-200 bg-white p-4 shadow-xs sm:p-5" style="animation-delay: 250ms" aria-label="Rechercher et filtrer les articles">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
                <div class="flex-1">
                    <label for="search" class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-500">Rechercher</label>
                    <input type="search" id="search" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher dans le titre..." class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs outline-none transition placeholder:text-gray-400 focus:border-indigo-400 focus:ring-3 focus:ring-indigo-100">
                </div>
                <div class="sm:w-56">
                    <label for="category_id" class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-500">Catégorie</label>
                    <select id="category_id" name="category_id" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 shadow-xs outline-none transition focus:border-indigo-400 focus:ring-3 focus:ring-indigo-100">
                        <option value="">Toutes les catégories</option>
                        @foreach ($categories ?? [] as $category)
                            <option value="{{ $category->id }}" @selected(($categoryId ?? 0) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="shine rounded-xl bg-linear-to-r from-indigo-600 to-violet-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-300 hover:scale-105 hover:shadow-md">Filtrer</button>
                @if (($search ?? '') !== '' || ($categoryId ?? 0) > 0)
                    <a href="{{ route('posts.index') }}" class="self-center text-sm font-medium text-gray-500 transition hover:text-indigo-600 hover:underline">Réinitialiser</a>
                @endif
            </div>
        </form>
    @endif

    <div class="mb-8 flex flex-wrap items-center justify-between gap-3">
        <p class="anim-fade-in text-sm text-gray-500" style="animation-delay: 300ms">
            {{ $posts->total() }} article{{ $posts->total() > 1 ? 's' : '' }} trouvé{{ $posts->total() > 1 ? 's' : '' }}
        </p>
        @auth
            <a href="{{ route('posts.create') }}" class="shine inline-flex items-center gap-2 rounded-full bg-linear-to-r from-indigo-600 to-violet-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:scale-105 hover:shadow-md">
                <span class="text-lg leading-none">+</span>
                Nouvel article
            </a>
        @endauth
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            <x-post-card :post="$post" :delay="$loop->index * 0.1" />
        @empty
            <x-alert type="info" title="Aucun article pour le moment" class="sm:col-span-2 lg:col-span-3">
                Les articles apparaîtront ici dès leur publication.
            </x-alert>
        @endforelse
    </div>

    @if ($posts->hasPages())
        <nav class="mt-10 flex flex-wrap items-center justify-between gap-4" aria-label="Pagination des articles">
            <p class="text-sm text-gray-500">Page {{ $posts->currentPage() }} sur {{ $posts->lastPage() }}</p>
            {{ $posts->onEachSide(1)->links() }}
        </nav>
    @endif
</x-layout>
