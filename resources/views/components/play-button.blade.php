{{-- Botón reproducir/pausar. $primario = ámbar (el único primario de la vista); si no, relleno ink. --}}
@props(['primario' => false])
@php
    $estilo = $primario
        ? 'size-14 bg-accent text-on-accent hover:bg-accent-hover'
        : 'size-10 bg-ink text-surface-base hover:bg-ink-muted';
@endphp
<button type="button" data-accion="alternar" aria-label="Reproducir"
    {{ $attributes->merge(['class' => "foco flex items-center justify-center rounded-pill transition $estilo"]) }}>
    <x-icon name="play" data-icono="play" />
    <x-icon name="pause" data-icono="pause" class="hidden" />
</button>
