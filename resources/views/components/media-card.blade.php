@props(['titulo', 'artista', 'duracion', 'href', 'barras' => [50, 80, 60, 90, 40]])
<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'foco group block rounded-md bg-surface-raised p-4 transition hover:bg-surface-high hover:shadow-raise']) }}>
    <x-portada :barras="$barras" class="mb-4 group-hover:bg-surface-base" />
    <h3 class="text-heading font-bold">{{ $titulo }}</h3>
    <p class="mt-1 text-body-sm font-medium text-ink-muted">{{ $artista }}</p>
    <p class="mt-2 font-mono text-mono-sm text-ink-muted">{{ $duracion }}</p>
</a>
