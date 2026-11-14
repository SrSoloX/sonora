<?php

namespace App\Support;

/**
 * Datos de ejemplo INVENTADOS (nada de artistas ni portadas reales).
 * Más adelante se puede reemplazar por el modelo Track (ver README, fase 2).
 */
class Catalogo
{
    /** @return array<int, array{id:int,titulo:string,artista:string,album:string,dur:int}> */
    public static function pistas(): array
    {
        $datos = [
            ['Noches de lluvia', 'Mar Abierto',   'Hora lenta',     258],
            ['Hora azul',        'Luz de Norte',  'Costa vacía',    232],
            ['Cuerdas',          'Estudio Cinco', 'Sala 5',         307],
            ['Caminos',          'Mar Abierto',   'Hora lenta',     209],
            ['Sin prisa',        'Luz de Norte',  'Costa vacía',    284],
            ['Faro del sur',     'Paso Lento',    'Mapa de sal',    241],
            ['Ventana abierta',  'Cielo Bajo',    'Tarde larga',    198],
            ['Marea baja',       'Mar Abierto',   'Hora lenta',     266],
            ['Café y neblina',   'Estudio Cinco', 'Sala 5',         223],
            ['Último tren',      'Paso Lento',    'Mapa de sal',    295],
        ];

        return array_map(
            fn ($d, $i) => [
                'id' => $i, 'titulo' => $d[0], 'artista' => $d[1], 'album' => $d[2], 'dur' => $d[3],
            ],
            $datos,
            array_keys($datos)
        );
    }

    /** @return array<int, array<string, mixed>> */
    public static function playlists(): array
    {
        $pistas = self::pistas();

        $listas = [
            [
                'slug' => 'mezcla-diaria-1', 'titulo' => 'Mezcla diaria 1', 'autor' => 'Para ti', 'tipo' => 'mezcla',
                'descripcion' => 'Canciones que te acompañan en el camino.',
                'ids' => [0, 1, 2, 3, 4, 5, 6, 7], 'barras' => [40, 70, 55, 90, 35],
            ],
            [
                'slug' => 'noches-de-lluvia', 'titulo' => 'Noches de lluvia', 'autor' => 'Playlist', 'tipo' => 'playlist',
                'descripcion' => 'Para escuchar con la ventana cerrada.',
                'ids' => [0, 4, 7, 8, 9], 'barras' => [80, 45, 65, 30, 75],
            ],
            [
                'slug' => 'sin-prisa', 'titulo' => 'Sin prisa', 'autor' => 'Mar Abierto', 'tipo' => 'playlist',
                'descripcion' => 'Ritmo lento para una tarde tranquila.',
                'ids' => [4, 3, 6, 1], 'barras' => [50, 85, 40, 70, 60],
            ],
            [
                'slug' => 'caminos', 'titulo' => 'Caminos', 'autor' => 'Para ti', 'tipo' => 'mezcla',
                'descripcion' => 'Una mezcla para recorrer la ciudad.',
                'ids' => [3, 5, 9, 2, 6], 'barras' => [30, 60, 90, 50, 80],
            ],
        ];

        return array_map(function ($l) use ($pistas) {
            $l['pistas'] = array_map(fn ($id) => $pistas[$id], $l['ids']);
            $l['total'] = array_sum(array_column($l['pistas'], 'dur'));
            $l['duracion'] = self::duracionTotal($l['total']);
            return $l;
        }, $listas);
    }

    public static function playlist(string $slug): ?array
    {
        foreach (self::playlists() as $lista) {
            if ($lista['slug'] === $slug) {
                return $lista;
            }
        }
        return null;
    }

    /** 258 → "04:18" */
    public static function tiempo(int $segundos): string
    {
        return sprintf('%02d:%02d', intdiv($segundos, 60), $segundos % 60);
    }

    /** 4360 → "1:12:40"; 2885 → "48:05" */
    public static function duracionTotal(int $segundos): string
    {
        $h = intdiv($segundos, 3600);
        $m = intdiv($segundos % 3600, 60);
        $s = $segundos % 60;
        return $h > 0 ? sprintf('%d:%02d:%02d', $h, $m, $s) : sprintf('%02d:%02d', $m, $s);
    }
}
