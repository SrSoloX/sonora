{{-- Barra de progreso del reproductor simulado. Controlable con flechas, Inicio y Fin. --}}
@php $p = \App\Support\Catalogo::pistas()[0]; @endphp
<div class="flex w-full items-center gap-2 font-mono text-mono-sm text-ink-muted">
    <span data-ui="tiempo">00:00</span>
    <div data-ui="barra" role="slider" tabindex="0" aria-label="Progreso de la canción"
        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" aria-valuetext="00:00 de {{ \App\Support\Catalogo::tiempo($p['dur']) }}"
        class="foco flex-1 cursor-pointer rounded-pill py-2">
        <div class="h-1 rounded-pill bg-surface-high">
            <div data-ui="relleno" class="h-1 rounded-pill bg-accent" style="width: 0%"></div>
        </div>
    </div>
    <span data-ui="duracion">{{ \App\Support\Catalogo::tiempo($p['dur']) }}</span>
</div>
