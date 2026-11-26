@props(['post', 'variant' => 'card'])

@php
    $themes = [
        'laravel' => [
            'gradient' => 'from-rose-500 via-red-500 to-orange-400',
            'icon' => 'fa-code',
        ],
        'frontend' => [
            'gradient' => 'from-sky-500 via-blue-500 to-indigo-600',
            'icon' => 'fa-laptop-code',
        ],
        'base-de-donnees' => [
            'gradient' => 'from-emerald-500 via-teal-500 to-cyan-500',
            'icon' => 'fa-database',
        ],
        'default' => [
            'gradient' => 'from-slate-600 via-gray-700 to-zinc-800',
            'icon' => 'fa-newspaper',
        ],
    ];

    $theme = $themes[$post->category?->slug] ?? $themes['default'];

    $variants = [
        'card' => ['icon' => 'text-5xl', 'badge' => 'left-4 top-4 px-3 py-1 text-xs'],
        'hero' => ['icon' => 'text-7xl sm:text-8xl', 'badge' => 'left-6 top-6 px-3 py-1.5 text-xs'],
        'thumb' => ['icon' => 'text-xl', 'badge' => null],
    ];

    $presentation = $variants[$variant] ?? $variants['card'];
    $badgeClasses = 'absolute z-10 rounded-full bg-white/95 font-bold text-gray-800 shadow-xs '.$presentation['badge'];
@endphp

<div {{ $attributes->merge(['class' => 'relative flex size-full items-center justify-center overflow-hidden bg-linear-to-br '.$theme['gradient']]) }}>
    <div class="pointer-events-none absolute inset-0 bg-linear-to-br {{ $theme['gradient'] }} transition-transform duration-500 group-hover:scale-110" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -right-10 -top-12 size-40 rounded-full bg-white/10 blur-2xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-14 left-1/4 size-40 rounded-full bg-black/10 blur-2xl" aria-hidden="true"></div>

    <i class="fa-solid {{ $theme['icon'] }} relative z-10 {{ $presentation['icon'] }} text-white/70 transition-transform duration-500 group-hover:scale-110" aria-hidden="true"></i>

    @if ($presentation['badge'])
        @if ($post->category)
            <a href="{{ route('posts.category', $post->category) }}" class="{{ $badgeClasses }}">{{ $post->category->name }}</a>
        @else
            <span class="{{ $badgeClasses }}">Sans catégorie</span>
        @endif
    @endif
</div>
