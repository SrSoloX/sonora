@php $p = \App\Support\Catalogo::pistas()[0]; @endphp
<section aria-label="Reproductor" class="flex flex-col gap-2 border-t border-line bg-surface-raised p-3 md:grid md:grid-cols-[1fr_2fr_1fr] md:items-center md:px-4">
    <a href="{{ route('reproductor') }}" class="foco rounded-md px-1">
        <span data-ui="titulo" class="block text-body-sm font-bold">{{ $p['titulo'] }}</span>
        <span data-ui="artista" class="block text-body-sm font-medium text-ink-muted">{{ $p['artista'] }}</span>
    </a>

    <div class="flex flex-col items-center gap-1">
        <div class="flex items-center gap-6">
            <x-icon-button etiqueta="Anterior" icono="prev" data-accion="anterior" />
            <x-play-button />
            <x-icon-button etiqueta="Siguiente" icono="next" data-accion="siguiente" />
        </div>
        <x-progreso />
    </div>

    <div class="hidden justify-end md:flex"><x-volumen /></div>
</section>
