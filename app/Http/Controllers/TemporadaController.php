<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemporadaController extends Controller
{
    public function crear($serieId)
{
    $serie = Serie::findOrFail($serieId);
    return view('admin.crear_temporadas_y_capitulos', compact('serie'));
}

public function guardar(Request $request, $serieId)
{
    $request->validate([
        'numero' => 'required|integer',
    ]);

    $temporada = Temporada::create([
        'serie_id' => $serieId,
        'numero' => $request->numero,
    ]);

    return redirect()->back()->with('success', 'Temporada creada correctamente.');
}

}
