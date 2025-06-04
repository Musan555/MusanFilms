<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapituloController extends Controller
{
    public function guardar(Request $request, $temporadaId)
{
    $request->validate([
        'titulo' => 'required',
        'numero' => 'required|integer',
        'url' => 'required|url',
    ]);

    Capitulo::create([
        'temporada_id' => $temporadaId,
        'titulo' => $request->titulo,
        'numero' => $request->numero,
        'url' => $request->url,
    ]);

    return redirect()->back()->with('success', 'Capítulo agregado correctamente.');
}

}
