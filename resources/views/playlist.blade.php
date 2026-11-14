@extends('layouts.app')

@section('titulo', $lista['titulo'].' · Sonora')

@section('contenido')
    <header class="flex flex-col gap-6 md:flex-row md:items-end">
        <x-portada :barras="$lista['barras']" :grande="true" class="w-48 shrink-0 md:w-56" />

        <div>
            <p class="text-caption font-bold uppercase tracking-caption text-ink-muted">
                {{ $lista['tipo'] === 'mezcla' ? 'Mezcla' : 'Playlist' }}
            </p>
            <h1 class="mt-1 text-title font-extrabold tracking-title">{{ $lista['titulo'] }}</h1>
            <p class="mt-2 text-body text-ink-muted">{{ $lista['descripcion'] }}</p>
            <p class="mt-2 font-mono text-mono text-ink-muted">{{ count($lista['pistas']) }} canciones · {{ $lista['duracion'] }}</p>

            <div class="mt-4 flex flex-wrap gap-2">
                {{-- Único botón primario ámbar de esta vista --}}
                <x-button data-reproducir="{{ $lista['pistas'][0]['id'] }}">Reproducir</x-button>

                {{-- El estado "guardado" lleva texto e icono, no solo color --}}
                <x-button variant="secondary" data-accion="guardar" aria-pressed="false" class="group flex items-center gap-2 aria-pressed:text-success">
                    <span class="group-aria-pressed:hidden">Guardar en tu biblioteca</span>
                    <span class="hidden items-center gap-2 group-aria-pressed:inline-flex"><x-icon name="heart" class="size-5 [&_path]:fill-current" /> Guardado</span>
                </x-button>
            </div>
        </div>
    </header>

    <section class="mt-8" aria-labelledby="canciones">
        <h2 id="canciones" class="sr-only">Canciones</h2>
        <div class="rounded-md bg-surface-raised p-2">
            @foreach ($lista['pistas'] as $i => $pista)
                <x-song-row :indice="$i" :pista="$pista" />
            @endforeach
        </div>
    </section>
@endsection
