<?php

namespace App\Http\Controllers;

use App\Support\Catalogo;

class SonoraController extends Controller
{
    public function inicio()
    {
        return view('inicio', [
            'playlists' => Catalogo::playlists(),
            'pistas' => Catalogo::pistas(),
        ]);
    }

    public function playlist(string $slug)
    {
        $lista = Catalogo::playlist($slug) ?? abort(404);

        return view('playlist', ['lista' => $lista]);
    }

    public function reproductor()
    {
        return view('reproductor', ['pistas' => Catalogo::pistas()]);
    }
}
