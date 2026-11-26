@props(['post', 'delay' => 0])

<article {{ $attributes->merge([
    'class' => 'group flex h-full flex-col anim-scale-in overflow-hidden rounded-2xl border border-gray-200/80 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-2xl hover:shadow-indigo-500/20',
    'style' => 'animation-delay: '.(int) round((float) $delay * 1000).'ms',
]) }}>
    <div class="relative h-44 overflow-hidden bg-gray-100">
        <x-post-thumbnail :post="$post" class="rounded-t-lg" />

        <a href="{{ route('posts.show', $post) }}" class="absolute inset-0" aria-label="Lire {{ $post->title }}"></a>

        @if (! $post->is_published)
            <span class="absolute right-4 top-4 z-10 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">Brouillon</span>
        @endif
    </div>

    <div class="flex flex-1 flex-col gap-4 p-5">
        <h2 class="text-xl font-bold leading-snug tracking-tight text-gray-900">
            <a href="{{ route('posts.show', $post) }}" class="transition-colors group-hover:text-indigo-600">{{ $post->title }}</a>
        </h2>

        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-500">
            <span class="inline-flex items-center gap-1.5">
                <span class="grid size-6 place-items-center rounded-full bg-indigo-100 text-[10px] font-bold text-indigo-700">{{ Str::upper(Str::substr($post->user?->name ?? '?', 0, 1)) }}</span>
                {{ $post->user?->name ?? 'auteur inconnu' }}
            </span>
            @if ($post->published_at)
                <span aria-hidden="true">•</span>
                <a href="{{ route('posts.archive', $post->published_at->year) }}" class="transition-colors hover:text-indigo-600 hover:underline">{{ $post->published_at->format('d/m/Y') }}</a>
            @else
                <span aria-hidden="true">•</span>
                <span>Non publié</span>
            @endif
        </div>

        <p class="line-clamp-3 text-sm leading-relaxed text-gray-600">{{ $post->excerpt ?? Str::limit($post->body, 160) }}</p>

        <div class="mt-auto space-y-4">
            @if ($post->tags->isNotEmpty())
                <ul class="flex flex-wrap gap-2" aria-label="Tags de l'article">
                    @foreach ($post->tags as $tag)
                        <li>
                            <a href="{{ route('posts.tag', $tag) }}" class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700 transition hover:bg-indigo-100">#{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 transition-all duration-300 group-hover:gap-2.5 group-hover:text-violet-600">
                Lire la suite
                <svg class="size-4 transition-transform duration-300 group-hover:translate-x-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</article>
