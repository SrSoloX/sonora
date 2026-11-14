<!doctype html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Sonora')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&family=Manrope:wght@400;500;700;800&display=swap">
    {{-- Aplica el tema guardado antes de pintar, para evitar el parpadeo --}}
    <script>try { document.documentElement.dataset.theme = localStorage.getItem('tema') || 'dark'; } catch (e) {}</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex h-dvh flex-col">
    <a href="#contenido" class="foco sr-only rounded-pill bg-surface-high px-4 py-2 text-body-sm font-bold focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-10">Saltar al contenido</a>

    <div class="grid min-h-0 flex-1 grid-rows-[auto_1fr] md:grid-cols-[200px_1fr] md:grid-rows-1">

        {{-- Navegación principal --}}
        <nav aria-label="Principal" class="flex flex-wrap items-center gap-2 bg-surface-raised p-4 md:flex-col md:items-stretch md:px-4 md:py-6">
            <x-logo class="mr-2 md:mb-6" />
            <x-nav-link :href="route('inicio')" icono="home" :activo="request()->routeIs('inicio')">Inicio</x-nav-link>
            <x-nav-link :href="route('playlist', 'mezcla-diaria-1')" icono="library" :activo="request()->routeIs('playlist')">Tus playlists</x-nav-link>
            <x-nav-link :href="route('reproductor')" icono="play" :activo="request()->routeIs('reproductor')">Reproduciendo</x-nav-link>
            <x-button variant="ghost" id="tema" class="ml-auto md:ml-0 md:mt-auto">Cambiar tema</x-button>
        </nav>

        <main id="contenido" tabindex="-1" class="min-h-0 overflow-y-auto px-4 py-6 md:px-8">
            @yield('contenido')
        </main>
    </div>

    {{-- La barra se oculta en la pantalla del reproductor (@section('sin-barra')) --}}
    @unless (View::hasSection('sin-barra'))
        <x-player-bar />
    @endunless

    {{-- Todas las canciones para el reproductor simulado (lo lee resources/js/app.js) --}}
    <script>window.pistas = @json(\App\Support\Catalogo::pistas());</script>
</body>
</html>
