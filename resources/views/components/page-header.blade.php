@props(['title', 'subtitle' => null])

<div {{ $attributes->merge(['class' => 'mb-10']) }}>
    <p class="anim-fade-in text-sm font-semibold uppercase tracking-wider text-indigo-600" style="animation-delay: 50ms">Blog Mini-CMS</p>
    <h1 class="anim-fade-up mt-1 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl" style="animation-delay: 100ms">{{ $title }}</h1>
    @if ($subtitle)
        <p class="anim-fade-in mt-3 max-w-2xl text-base leading-relaxed text-gray-600" style="animation-delay: 200ms">{{ $subtitle }}</p>
    @endif
</div>
