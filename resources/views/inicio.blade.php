@extends('layouts.app')

@section('titulo', 'Inicio · Sonora')

@section('contenido')
    <div class="mb-6 flex flex-wrap gap-2" role="group" aria-label="Filtrar por tipo">
        <x-chip :activo="true" data-filtro="todo">Todo</x-chip>
        <x-chip data-filtro="mezcla">Mezclas</x-chip>
        <x-chip data-filtro="playlist">Playlists</x-chip>
    </div>

    <h1 class="text-title font-extrabold tracking-title">Buenas tardes</h1>
    <p class="mt-1 text-body text-ink-muted">Retoma tu música donde la dejaste.</p>

    {{-- Único botón primario ámbar de esta vista --}}
    <x-button class="mt-4" data-reproducir="0">Reproducir tu mezcla</x-button>

    <h2 class="mb-4 mt-8 text-heading font-bold">Tus playlists</h2>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        @foreach ($playlists as $p)
            <x-media-card
                :href="route('playlist', $p['slug'])"
                :titulo="$p['titulo']" :artista="$p['autor']" :duracion="$p['duracion']" :barras="$p['barras']"
                :data-tipo="$p['tipo']" />
        @endforeach
    </div>

    <h2 class="mb-4 mt-8 text-heading font-bold">En cola</h2>
    <div class="max-w-md rounded-md bg-surface-raised p-2">
        @foreach ($pistas as $i => $pista)
            <x-song-row :indice="$i" :pista="$pista" />
        @endforeach
    </div>
@endsection
