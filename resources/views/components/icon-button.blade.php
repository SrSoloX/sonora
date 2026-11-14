{{-- Botón de solo icono: SIEMPRE lleva etiqueta accesible (aria-label). --}}
@props(['etiqueta', 'icono'])
<button type="button" aria-label="{{ $etiqueta }}"
    {{ $attributes->merge(['class' => 'foco flex size-10 items-center justify-center rounded-pill text-ink transition hover:bg-surface-high aria-pressed:bg-surface-high aria-pressed:[&_path]:fill-current']) }}>
    <x-icon :name="$icono" />
</button>
