@extends('layouts.app')

@section('titulo', 'Reproduciendo · Sonora')
@section('sin-barra', '1')

@section('contenido')
    @php $p = $pistas[0]; @endphp

    <div class="grid gap-8 md:grid-cols-[minmax(0,24rem)_1fr] md:items-center">
        <x-portada :barras="[40, 70, 55, 90, 35]" :grande="true" class="w-full max-w-sm" />

        <div>
            <p class="text-caption font-bold uppercase tracking-caption text-ink-muted">Reproduciendo ahora</p>
            <h1 data-ui="titulo" class="mt-2 text-title font-extrabold tracking-title md:text-display md:tracking-display">{{ $p['titulo'] }}</h1>
            <p data-ui="artista" class="mt-2 text-heading font-bold text-ink-muted">{{ $p['artista'] }}</p>

            <div class="mt-6 max-w-lg"><x-progreso /></div>

            <div class="mt-4 flex flex-wrap items-center gap-4">
                <x-icon-button etiqueta="Reproducción aleatoria" icono="shuffle" data-accion="aleatorio" aria-pressed="false" />
                <x-icon-button etiqueta="Anterior" icono="prev" data-accion="anterior" />
                {{-- Único botón primario ámbar de esta vista --}}
                <x-play-button :primario="true" />
                <x-icon-button etiqueta="Siguiente" icono="next" data-accion="siguiente" />
                <x-icon-button etiqueta="Guardar en tu biblioteca" icono="heart" data-accion="guardar" aria-pressed="false" />
                <x-volumen />
            </div>
        </div>
    </div>

    <h2 class="mb-4 mt-8 text-heading font-bold">En cola</h2>
    <div class="max-w-md rounded-md bg-surface-raised p-2">
        @foreach ($pistas as $i => $pista)
            <x-song-row :indice="$i" :pista="$pista" />
        @endforeach
    </div>
@endsection
