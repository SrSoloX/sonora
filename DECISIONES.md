# Decisiones de diseño y código

## Componentes que reutilicé
- `x-button` (primario, secundario, fantasma), `x-chip` y `x-media-card`, tal como pide el sistema.
- `x-song-row` en Inicio, Playlist y Reproductor (misma fila, tres pantallas).
- `x-portada` en tarjetas, cabecera de playlist y reproductor: un solo marcador de portada con barras ámbar.
- `x-progreso`, `x-play-button` y `x-icon-button` en la barra y en el reproductor grande.

## Reglas del sistema que apliqué
- Solo tokens: ningún hexadecimal fuera de `resources/css/app.css`. Tipografía con tokens propios (`text-title`, `text-heading`, `text-body-sm`, `text-mono-sm`…) tomados de `tokens.json`.
- Un solo botón primario ámbar por vista: "Reproducir tu mezcla" (Inicio), "Reproducir" (Playlist) y el botón grande de reproducir (Reproductor). El botón de la barra inferior usa relleno `ink` para no competir.
- Manrope para texto y JetBrains Mono para tiempos y conteos; textos en español, minúsculas de oración, sin emojis ni exclamaciones.
- Divisores con `line`, bordes de controles con `line-strong`, movimiento de 120 ms.

## Qué cambiaría
- La cola es siempre el catálogo completo; al reproducir desde una playlist, "siguiente" no se queda dentro de ella.
- Pasar los datos a un modelo `Track` con migración y seeder (fase 2).
- Agregar la pantalla Buscar y un menú propio para la navegación en móvil.
